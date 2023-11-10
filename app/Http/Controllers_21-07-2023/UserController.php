<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use App\Models\Product;
use App\Models\Passport;
use App\Models\PassportOrder;
use App\Models\PassportUsedOrder;
use App\Models\Coupon;

use Cart;
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
        // echo '<pre>'; print_r($data['products']->toArray()); die;
        // return view('home',$data);
    }

    public function get_user_order(Request $request)
    {
        $product_arr = array();
        $data['orders'] = Order::where('status', 1)->where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();

        // echo '<pre>orders - '; print_r($data['orders']->toArray()); die;
        return view('front/users/my_orders', $data);
    }

    public function get_user_order_details(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all()); die;
        $id = $request->id;
        $data = array();
        $order = Order::where('id', $id)->first()->toArray();
        if (!$order) {

            return response()->json(['success' => 0, 'message' => 'Invalid Order']);
        } else {
            $data['order'] = $order;

            $p = Item::where('items.order_id', $id);
            $items = $p->get()->toArray();
            // echo '<pre>items - '; print_r($items); die;
            $i = 0;
            foreach ($items as $item) {
                $data['order']['items'][$i] = $item;
                $data['order']['items'][$i]['product'] = $this->getProductDetail($item['product_id']);
                $i++;
            }

            // echo '<pre>orders_items - '; print_r($data['order']['items']); die;
            $view = view('front/users/order_products_view', $data);
            return response()->json(['success' => 1, 'view' => $view->render()]);
        }
    }

    public function getProductDetail($id)
    {
        $product_arr = array();
        $product = Product::find($id);

        $product_arr = $product;
        $product_arr['image'] = asset($product->FileId->file);
        $product_arr['type_name'] = $product->Type->name;
        $product_arr['category_name'] = $product->Category->name;
        $product_arr['place_name'] = $product->Place->name;
        $product_arr['location_name'] = $product->Place->Location->name;

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
        // echo '<pre>orders - '; print_r($data['orders']->toArray()); die;
        return view('front/users/my_passports', $data);
    }

    public function get_user_passport_details(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all()); die;
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

            // echo '<pre>items - '; print_r($items->toArray()); die;
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
            // echo '<pre>orders_items - '; print_r($data['orders']); die;
            $view = view('front/users/passport_details_view', $data);
            return response()->json(['success' => 1, 'view' => $view->render()]);
        }
    }

    public function codeView(Request $request)
    {
        $data['type'] = $request->type;
        // echo '<pre>orders_items - '; print_r($data['order']); die;
        $data['passport_orders'] = PassportOrder::where(['user_id' => auth()->user()->id, 'status' => 1])->where('remaining_amount', '!=', 0)->get();
        $view = view('front/users/coupon_view', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }

    public function sendPassportOtp(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all()); die;
        $data['type'] = $request->type;
        // echo '<pre>orders_items - '; print_r($data['order']); die;
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
        // echo '<pre>request - '; print_r($request->all()); die;
        // $content = Cart::content();
        // echo '<pre>';print_r($content->toArray()); die;

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'otp' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $validator->validate();
        } else {

            // $usedPassport = PassportUsedOrder::where('passport_used_orders.passport_code',$request->code)->select('passport_used_orders.*','passports.per_day_use')->leftJoin('passport_orders','passport_orders.passport_code','=','passport_used_orders.passport_code')->leftJoin('passports','passports.id','=','passport_orders.passport_id')->orderBy('passport_used_orders.id','DESC')->first();

            $usedPassport = PassportUsedOrder::where('passport_used_orders.passport_code', $request->code)->orderBy('passport_used_orders.id', 'DESC')->first();

            $today = date('d-m-y');
            if ($usedPassport) {
                $useDate = date('d-m-y', strtotime($usedPassport->created_at));
            }
            // echo '<pre>usedPassport - '; print_r($usedPassport->toArray()); die;

            if ((isset($usedPassport) && !empty($usedPassport->toArray())) && $useDate == $today) {
                return response()->json([
                    'success' => 0,
                    'message' => 'This passport has been already used today.',
                ]);
            }

            $passport_data = PassportOrder::where('passport_orders.passport_code', $request->code)->select('passport_orders.*', 'passports.per_day_use')->leftJoin('passports', 'passports.id', '=', 'passport_orders.passport_id')->orderBy('passport_orders.id', 'DESC')->first();

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
                // echo '<pre>request - '; print_r($request->all()); die;
                foreach ($content as $con) {
                    $total_with_tax += $con->qty * $con->options->total_price;
                    $price_total += $con->qty * $con->options->product_price;
                }

                // $tax_total = $total_with_tax - $price_total; 

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
        // echo '<pre>request - '; print_r($request->all()); die;
        $getLocation = session('location');
        //  echo $getLocation;die;

        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $validator->validate();
        } else {
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

            $tax_total = $total_with_tax - $price_total;

            $total = str_replace(',', '', $price_total);

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

                // echo $total;
                // echo "<pre>coupon - "; print_r($coupon->toArray()); die;
                // $c_loc = explode(',',$coupon->locations);

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
        // echo $mobile.' - '.$message; //die;
        if (!empty($mobile) && !empty($message)) {

            // $message = "0045 is your OTP to login to Finch BrewCafe Account";
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
