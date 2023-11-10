<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use App\Models\Product;
use App\Models\Passport;
use App\Models\PassportOrder;
use App\Models\PassportUsedOrder;
use App\Models\Coupon;
use App\Models\PassportFreeItem;
use App\Models\ProductMeta;
use App\Models\User;
use App\Models\GeneralSetting;
use Cart;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    }

    public function get_user_order(Request $request)
    {
        $product_arr = array();
        $data['orders'] = Order::where('status', 1)->where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();


        return view('front/users/my_orders', $data);
    }

    public function get_user_order_details(Request $request)
    {

        $id = $request->id;
        $data = array();
        $order = Order::where('id', $id)->first()->toArray();
        if (!$order) {

            return response()->json(['success' => 0, 'message' => 'Invalid Order']);
        } else {
            $data['order'] = $order;

            $p = Item::where('items.order_id', $id);
            $items = $p->get()->toArray();

            $i = 0;
            foreach ($items as $item) {
                $data['order']['items'][$i] = $item;
                $data['order']['items'][$i]['product'] = $this->getProductDetail($item['product_id']);
                $i++;
            }

            $view = view('front/users/order_products_view', $data);
            return response()->json(['success' => 1, 'view' => $view->render()]);
        }
    }

    public function getProductDetail($id)
    {

        $product_arr = array();
        $product = Product::find($id);
        $product_arr = $product;
        $product_arr['image'] = asset(@$product->FileId->file);
        $product_arr['type_name'] = @$product->Type->name;
        $product_arr['category_name'] = @$product->Category->name;
        $product_arr['place_name'] = @$product->Place->name;
        $product_arr['location_name'] = @$product->Place->Location->name;

        if ($product->type == 1) {
            $product_arr['malts'] = get_malt_explode($product->malt);
            $product_arr['hops'] = get_hop_explode($product->hops);
        } else {
            unset($product_arr['hops']);
            unset($product_arr['malt']);
            unset($product_arr['quantity']);
            unset($product_arr['percentage']);
            unset($product_arr['color']);
            unset($product_arr['orignal_gravity']);
            unset($product_arr['style']);
        }

        unset($product_arr['created_at']);
        unset($product_arr['updated_at']);
        unset($product_arr['status']);
        return $product_arr->toArray();
    }

    public function get_user_passports(Request $request)
    {
        $product_arr = array();
        // $data['orders'] = PassportOrder::where(['user_id' => auth()->user()->id, 'is_approw' => 1])->get();
        $data['orders'] = PassportOrder::where(['user_id' => auth()->user()->id])->get();

        return view('front/users/my_passports', $data);
    }

    public function get_user_passport_details(Request $request)
    {

        $id = $request->id;
        $product_arr = array();
        $passportOrder = PassportOrder::select('passport_code')->where('id', $id)->first();
        if (!$passportOrder) {

            return response()->json([
                'success' => false,
                'message' => 'Invalid Order.',
            ], 400);
        } else {

            $order_data = array();
            $passport_code = $passportOrder['passport_code'];
            $items = PassportUsedOrder::select('order_type', 'order_date', 'amount', 'created_at')->where('passport_code', $passport_code)->get();

            $i = 0;
            foreach ($items as $item) {
                $order_data[$i]['order_date'] = date('d M, Y', strtotime($item->created_at));
                $order_data[$i]['amount'] = $item->amount;
                $order_type = 'Direct';
                if ($item->order_type == 1) {
                    $order_type = 'Online order';
                }
                if ($item->order_type == 2) {
                    $order_type = 'Custom order';
                }
                $order_data[$i]['order_type'] = $order_type;

                $i++;
            }

            $data['orders'] = $order_data;
            $data['passport_code'] = $passport_code;
            $view = view('front/users/passport_details_view', $data);
            return response()->json(['success' => 1, 'view' => $view->render()]);
        }
    }

    public function codeView(Request $request)
    {
        $data['type'] = $request->type;


        $data['passport_orders'] = PassportOrder::where(['user_id' => auth()->user()->id, 'status' => 1])->where('remaining_amount', '!=', 0)->get();


        $view = view('front/users/coupon_view', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }

    public function freeProduct(Request $request)
    {
        $pid = $request->id;
        $passportOrder = PassportOrder::where(['id' => $pid])->where('remaining_amount', '!=', 0)->first();


        $freePassportId = explode(',', $passportOrder->is_free);


        $data['products'] = PassportFreeItem::select('products.*')->where('passport_id', $passportOrder->passport_id)->where('products.status', 1)->whereNotIn('products.id', $freePassportId)->join('products', 'products.id', '=', 'passport_free_item.product_id')->get();

        // echo "<pre>";
        // print_r($data['products']->toArray());
        // die;
        $view = view('front/users/freeProduct', $data);

        return response()->json(['success' => 1, 'view' => $view->render()]);
    }

    public function freeproductView(Request $request)
    {

        if ($request->row_id && $request->qty) {
            $data['row_id'] = $request->row_id;
            $data['qty'] = $request->qty;
        } else {
            $data['product'] = Product::where(['id' => $request->id, 'status' => 1])->first();
            $data['pimage'] = asset($data['product']->FileId->file);

            $attr = array();
            $meta_arr = ProductMeta::where(['product_id' => $request->id])->get()->toArray();
            if (is_array($meta_arr) && !empty($meta_arr)) {
                $attr_id = $meta_arr[0]['attribute_id'];
                foreach ($meta_arr as $key => $value) {
                    $attr[$key]['attr_id']  = $attr_id;


                    $attr_obj = Attribute::where(['id' => $attr_id])->first();

                    if ($attr_obj) {
                        $attr_name = array_values($attr_obj->toArray());
                        $attr_name_str = $attr_name[1];
                    } else {
                        $attr_name_str = '';
                    }


                    $attr[$key]['attr_name']  = $attr_name_str;
                    $attr[$key]['option_id']  = $value['option_id'];
                    $option_name  = array_values(AttributeOption::select('option_name')->where(['id' => $value['option_id']])->first()->toArray());
                    $attr[$key]['option_name'] = $option_name[0];
                    $attr[$key]['regular_price'] = $value['regular_price'];
                    $attr[$key]['tax'] = $value['tax'];
                    $attr[$key]['total_price'] = $value['regular_price'] + ($value['regular_price'] * $value['tax']) / 100;
                }
            }


            $data['attr'] = $attr;
        }

        $view = view('front/users/free_product_view', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }


    public function sendPassportOtp(Request $request)
    {
        $data['type'] = $request->type;
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $validator->validate();
        } else {

            $passportOrder = PassportOrder::where('user_id', auth()->user()->id)->where('passport_code', $request->code)->first();

            if (!$passportOrder) {
                return response()->json([
                    'success' => 0,
                    'message' => 'Invalid Passport Code.'
                ]);
            } else {
                if ($passportOrder->end_date < date('Y-m-d')) {
                    return response()->json([
                        'success' => 0,
                        'message' => 'Passport expired.'
                    ]);
                } elseif ($passportOrder->remaining_amount == 0) {
                    return response()->json([
                        'success' => 0,
                        'message' => 'Insufficient balance.'
                    ]);
                } else {
                    $phone = $passportOrder->User->phone;
                    $otp = rand(1111, 9999);

                    PassportOrder::where('passport_code', $request->code)->update(array('otp' => $otp));

                    $message = $otp . ' is your OTP to login to Finch BrewCafe Account';
                    $this->sendMessage($phone, $message);
                    return response()->json([
                        'success' => 1,
                        'message' => 'Otp successfully send on ' . auth()->user()->phone,
                        'otp' => $otp
                    ]);
                }
            }

            $view = view('front/users/coupon_view', $data);
            return response()->json(['success' => 1, 'view' => $view->render()]);
        }
    }

    public function passportOtpVerify(Request $request)
    {

        // echo "<pre>>";print_r($request->all)
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->validate();
        } else {

            // $usedPassport = PassportUsedOrder::where('passport_used_orders.passport_code',$request->code)->select('passport_used_orders.*','passports.per_day_use')->leftJoin('passport_orders','passport_orders.passport_code','=','passport_used_orders.passport_code')->leftJoin('passports','passports.id','=','passport_orders.passport_id')->orderBy('passport_used_orders.id','DESC')->first();

            // $usedPassport = PassportUsedOrder::where('passport_used_orders.passport_code', $request->code)->orderBy('passport_used_orders.id', 'DESC')->first();
            $passport_data = PassportOrder::where('passport_orders.passport_code', $request->code)->select('passport_orders.*', 'passports.per_day_use')->leftJoin('passports', 'passports.id', '=', 'passport_orders.passport_id')->orderBy('passport_orders.id', 'DESC')->first();

            $passports = Passport::where('id', $passport_data->passport_id)->first();


            $ldate = date('Y-m-d');
            $usedPassport = PassportUsedOrder::where('passport_code',  $request->code)->where('user_id', session('uid'))->where(DB::raw('CAST(created_at as DATE)'), $ldate)->sum('amount');


            $today = date('d-m-y');
            // if ($usedPassport) {
            //     $useDate = date('d-m-y', strtotime($usedPassport->created_at));
            // }

            if (!empty($usedPassport) && $passports->per_day_use <= $usedPassport) {
                return response()->json([
                    'success' => 0,
                    'message' => "Your passport's daily limit is over",
                ]);
            }
            // echo "<pre>";print_r($passports->per_day_use);die;



            User::where('id', session('uid'))->update([
                'passport_order' => $passport_data->id,
            ]);


            $per_day_use = 0;
            $coupon_amount = $total_pay = 0;
            $passportOrder = PassportOrder::where('passport_code', $request->code)->where('otp', $request->otp)->first();

            if (!empty($passport_data->per_day_use)) {
                $per_day_use = $passport_data->per_day_use;
            }

            if ($passportOrder) {
                $remaining_amount = $passportOrder->remaining_amount;

                $total_with_tax = 0;
                $price_total = 0;

                $content = Cart::content();
                foreach ($content as $con) {
                    $total_with_tax += $con->qty * $con->options->total_price;
                    $price_total += $con->qty * $con->options->product_price;
                }

                $total = str_replace(',', '', $total_with_tax);

                if ($total > $remaining_amount) {
                    // echo 'if'; die;
                    $t_total = $total - ($total * $per_day_use / 100);
                    $coupon_amount = ($total * $per_day_use / 100);
                    $total_pay = $t_total;
                } else {
                    $t_total = $total - ($total * $per_day_use / 100);
                    $total_pay = $t_total;
                    // $total_pay = 0;
                    $coupon_amount = ($total * $per_day_use / 100);
                }

                if ($coupon_amount > $remaining_amount) {
                    $coupon_amount = $remaining_amount;
                    $total_pay = $total - $remaining_amount;
                }

                $total_pay = $total_pay;
                // $total_pay = $total_pay + $tax_total ;

                //  echo $coupon_amount.' - remaining_amount'.$remaining_amount.' - total_pay'.$total_pay; die;

                return response()->json(['success' => 1, 'code' => $request->code, 'message' => 'Code applied successfully', 'coupon_amount' => number_format($coupon_amount, 2), 'total_amt' => number_format($total_pay, 2)]);
            } else {
                return response()->json([
                    'success' => 0,
                    'message' => 'Invalid Otp.',
                ]);
            }
        }
    }

    public function applyCouponCode(Request $request)
    {

        $minimum_purchase_amount = GeneralSetting::select('meta_value')->where('meta_key', 'minimum_purchase_amount')->first();
        $delivery_charges = GeneralSetting::select('meta_value')->where('meta_key', 'delivery_charges')->first();
        $delivery_tax = GeneralSetting::select('meta_value')->where('meta_key', 'deliveryTax')->first();

        $getLocation = session('location');

        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->validate();
        } else {

            $user = User::where('id', session('uid'))->first();
            if (!empty($user->passport_order)) {
                return response()->json([
                    'success' => 0,
                    'message' => "Either coupon or passport can be applied but not both",
                ]);
            }
            $payment_id = $passport_code = $coupon_code = '';
            $passport_pay = $coupon_percent = $coupon_amount = $discount = 0;
            $type = $request->type;

            $total_with_tax = 0;
            $price_total = 0;

            $content = Cart::content();
            foreach ($content as $con) {
                $total_with_tax += $con->qty * $con->options->total_price;
                $price_total += $con->qty * $con->options->product_price;
            }

            $totalData = str_replace(',', '', $price_total);


            if ($totalData <= $minimum_purchase_amount['meta_value']) { //echo"a";die;
                // echo "<pre>";print_r($minimum_purchase_amount['meta_value']);die;
                if (session('orderType') == 0) {
                    $deliveryTax = $delivery_tax['meta_value'] * $delivery_charges['meta_value'] / 100;
                    $total = $totalData + $delivery_charges['meta_value'] + $deliveryTax;
                } else {
                    $total = $totalData;
                }
            } else {
                $total = $totalData;
            }
            $tax_total = $total_with_tax - $price_total;



            $payment_date = date('Y-m-d');
            if ($type == 4) {
                $payment_id = $request->payment_id;
                $coupon = Coupon::where('discount_code', $request->code)->first();
                if (!$coupon) {
                    return response()->json([
                        'success' => 0,
                        'message' => 'Invalid Coupon Code.',
                    ]);
                }
                $p = Coupon::where('discount_code', $request->code);
                $p->whereRaw("find_in_set('$getLocation',locations) > 0");
                $c_loc = $p->first();

                if (!$c_loc) {
                    return response()->json([
                        'success' => 0,
                        'message' => 'This coupon code is not applied for this location.',
                    ]);
                }
                $new_total = round(($coupon->discount / 100) * $total);
                $coupon_amount = $new_total;
                $total_pay = $total - $new_total + $tax_total;



                return response()->json(['success' => 1, 'code' => $request->code, 'message' => 'Code applied successfully', 'coupon_amount' => number_format($coupon_amount, 2), 'total_amt' => number_format($total_pay, 2)]);
            }
        }
    }


    public function sendMessage($mobile, $message)
    {
        if (!empty($mobile) && !empty($message)) {
            $DLT_TE_ID = 1307165105706318624;
            $mobile = '91' . $mobile;
            $route = 31;
            $api_key = 'zDgLLhTAOk60jFEMUB8j6A';
            $encodedMessage = urlencode($message);
            $sender = 'FINBRC';

            $url = "http://sms.myewards.com/api/mt/SendSMS?APIKey=" . $api_key . "&senderid=" . $sender . "&channel=2&DCS=0&flashsms=0&number=" . $mobile . "&text=" . $encodedMessage . "&route=" . $route . "&dlttemplateid=" . $DLT_TE_ID;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 80);

            $response = curl_exec($ch);
            //echo '<pre>';print_r($response);die;  
            if (curl_error($ch)) {
                // echo 'Request Error:' . curl_error($ch);
                return false;
            } else {
                // echo '<pre>';print_r($response);die;  
                // echo 'true - '.$response;
                return true;
            }
            curl_close($ch);
        }
    }
}
