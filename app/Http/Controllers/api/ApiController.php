<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use JWTAuth;
use App\Models\User;
use App\Models\Order;
use App\Models\Item;
use App\Models\Product;
use App\Models\PassportOrder;
use App\Models\Passport;
use App\Models\PassportUsedOrder;
use App\Models\GeneralSetting;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use DB;
use Helper;
use Illuminate\Support\Arr;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        //Validate data
        $data = $request->only('name', 'email', 'phone');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:11|numeric|unique:users'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        $otp = rand(1111, 9999);

        //Request is valid, create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'otp' => $otp
        ]);

        $message = $otp . ' is your OTP to login to Finch BrewCafe Account';
        $this->sendMessage($request->phone, $message);
        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Otp send successfully',
            'data' => $user->otp
        ], Response::HTTP_OK);
    }


    public function otp_verify(Request $request)
    {
        $credentials = $request->only('phone');


        $data = $request->only('phone', 'otp');
        $validator = Validator::make($data, [
            'phone' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        $data = User::where('phone', $credentials['phone'])->first();
        if ($data->type == 0) {
            $user = User::select('id', 'name', 'email', 'phone', 'is_new')->where('phone', $request->phone)->where('otp', $request->otp)->first();
            if ($user) {
                try {
                    if (!$token = JWTAuth::fromUser($user)) {

                        return response()->json([
                            'success' => false,
                            'message' => 'Login credentials are invalid.',
                        ], 400);
                    } else {
                        User::where('phone', $request->phone)->update(array('otp' => ''));
                    }
                } catch (JWTException $e) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Could not create token.',
                    ], 500);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Otp Verify successfully',
                    'token' => $token,
                    'userInfo' => $user
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'invalid Otp.',
                ], 400);
            }
        } else {
            $user = User::select('id', 'name', 'email', 'phone', 'is_new')->where('phone', $request->phone)->where('login_pin', $request->pin)->first();
            if ($user) {
                try {
                    if (!$token = JWTAuth::fromUser($user)) {

                        return response()->json([
                            'success' => false,
                            'message' => 'Login credentials are invalid.',
                        ], 400);
                    } else {
                        User::where('phone', $request->phone)->update(array('otp' => ''));
                    }
                } catch (JWTException $e) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Could not create token.',
                    ], 500);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Pin Verify successfully',
                    'token' => $token,
                    'userInfo' => $user
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'invalid Pin.',
                ], 400);
            }
        }
    }


    public function cheaklowBalace(Request $request)
    {

        @$minimumAmount = GeneralSetting::where('id', 9)->first();
        @$Passport_Minimum_Amount = $minimumAmount->meta_value;

        @$remainAmounts = PassportOrder::where('user_id', auth()->user()->id)->get();
        // @$Passport_Remain_Amount = $remainAmount->remaining_amount;
        $remain_amount = 0;
        foreach ($remainAmounts as $remainAmount) {
            $remain_amount += $remainAmount->remaining_amount;
        }

        if ($remain_amount < $Passport_Minimum_Amount) {

            return response()->json(['status' => 0, 'msg' => 'Your Amount is low']);
        } else {

            return response()->json(['status' => 1, 'msg' => 'Your Amount is Grater then less amount']);
        }
    }


    public function resend_otp(Request $request)
    {
        $credentials = $request->only('phone');

        //valid credential
        $validator = Validator::make($credentials, [
            'phone' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $user = User::where('phone', $request->phone)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        } else {
            $otp = rand(1111, 9999);

            User::where('phone', $request->phone)->update(array('otp' => $otp));

            $message = $otp . ' is your OTP to login to Finch BrewCafe Account';
            $this->sendMessage($user->phone, $message);

            return response()->json([
                'success' => true,
                'message' => 'Otp send successfully',
                'data' => $otp
            ], Response::HTTP_OK);
        }
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->only('phone');

        $type = $request->only('type');



        if (empty($type)) {
            $type_data = 0;
        } else {
            $type_data = $type['type'];
        }
        // echo "<pre>";
        // print_r($type_data);
        // die;



        //valid credential
        $validator = Validator::make($credentials, [
            'phone' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $user = User::where('phone', $request->phone)->orWhere('email', $request->phone)->first();
        $otp = rand(1111, 9999);
        if (!$user) {
            if (is_numeric($request->phone)) {
                $user = User::create([
                    'phone' => $request->phone,
                    'otp' => $otp
                ]);

                // $message = $otp.' is your OTP to login to Finch at eWards';
                // $this->sendMessage($request->phone, $message);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'You need register with phone number',
                ], 400);
            }
        }

        User::where('id', $user->id)->update(array('otp' => $otp, 'type' => $type_data));
        $message = $otp . ' is your OTP to login to Finch BrewCafe Account';

        if ($type_data == 0) {
            $this->sendMessage($user->phone, $message);
            return response()->json([
                'success' => true,
                'message' => 'Otp send successfully on ' . $user->phone,
                'data' => $otp
            ], Response::HTTP_OK);
        } else {
            $data = User::where('phone', $user->phone)->first();

            return response()->json([
                'success' => true,
                'message' => 'Please Login With your Login Pin',
                'data' => $data->login_pin,
            ], Response::HTTP_OK);
        }
    }




    public function logout(Request $request)
    {
        $token = JWTAuth::getToken();

        //Request is validated, do logout        
        try {
            JWTAuth::invalidate($token);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get_user(Request $request)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {

            $uinfo = User::select('id', 'name', 'email', 'phone')->where('id', $user->id)->first();
            return response()->json([
                'success' => true,
                'message' => 'User Info',
                'userInfo' => $uinfo
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }




    public function updateInfo(Request $request)
    {

        if ($user = JWTAuth::parseToken()->authenticate()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'required|min:11|numeric|unique:users,phone,' . $user->id,
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            $uarray = array(
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'login_pin' => $request->login_pin,
                'is_new' => 1
            );

            User::where('id', $user->id)->update($uarray);
            $uinfo = User::select('id', 'name', 'email', 'phone', 'login_pin', 'is_new')->where('id', $user->id)->first();
            return response()->json([
                'success' => true,
                'message' => 'User Info Update Successfully',
                'userInfo' => $uinfo
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }


    public function check_token(Request $request)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {

            $uinfo = User::select('id', 'name', 'email', 'phone')->where('id', $user->id)->first();
            return response()->json([
                'success' => true,
                'message' => 'User Info',
                'userInfo' => $uinfo
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }


    public function get_user_order(Request $request)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
            $product_arr = array();
            $orders = Order::select('id', 'name', 'phone', 'address', 'total', 'sub_total', 'qty', 'payment_id', 'order_date', 'payment_date')->where('status', 1)->where('user_id', $user->id)->get();

            return response()->json([
                'success' => true,
                'message' => 'My orders',
                'data' => $orders
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }



    public function order_detail(Request $request, $id)
    {

        if ($user = JWTAuth::parseToken()->authenticate()) {
            $product_arr = array();

            $orderData = Order::select('id', 'name', 'phone', 'address', 'total', 'sub_total', 'qty', 'payment_id', 'order_date', 'payment_date')->where('id', $id)->first();
            if (!empty($orderData)) {
                $order = Order::select('id', 'name', 'phone', 'address', 'total', 'sub_total', 'qty', 'payment_id', 'order_date', 'payment_date')->where('id', $id)->first()->toArray();
            }
            if (!$orderData) {

                return response()->json([
                    'success' => false,
                    'message' => 'invalid Order.',
                ], 400);
            } else {
                $order_data = array();
                $order_data['order'] = $order;

                $p = Item::select('items.id', 'items.product_id', 'items.price', 'items.sub_total', 'items.qty');
                $p->where('items.order_id', $id);
                $items = $p->get()->toArray();
                $i = 0;
                foreach ($items as $item) {
                    $order_data['order']['items'][$i] = $item;
                    $order_data['order']['items'][$i]['product'] = $this->getProductDetail($item['product_id']);
                    $i++;
                }



                return response()->json([
                    'success' => true,
                    'message' => 'Order Detail',
                    'data' => $order_data
                ], Response::HTTP_OK);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
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

        if (@$product->type == 1) {
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
        // echo "<pre>";print_r($product_arr);die;
        return $product_arr;
    }

    public function get_user_passport_order(Request $request)
    {

        if ($user = JWTAuth::parseToken()->authenticate()) {
            $product_arr = array();
            $orders = PassportOrder::select('id', 'passport_code', 'passport_id', 'name', 'phone', 'email', 'price', 'payment_id', 'order_date', 'end_date', 'payment_date', 'volume_amount', 'used_amount', 'remaining_amount', 'start_date', 'end_date')->where('status', 1)->where('user_id', $user->id)->where('end_date', '>', date('Y-m-d'))->get();
            return response()->json([
                'success' => true,
                'message' => 'My Passport orders',
                'data' => $orders
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }


    public function passport_order_detail(Request $request, $id)
    {

        if ($user = JWTAuth::parseToken()->authenticate()) {
            $product_arr = array();
            $passportOrder = PassportOrder::select('passport_code')->where('id', $id)->first();
            if (!$passportOrder) {

                return response()->json([
                    'success' => false,
                    'message' => 'invalid Order.',
                ], 400);
            } else {

                $order_data = array();
                $passport_code = $passportOrder['passport_code'];
                $items = PassportUsedOrder::select('order_type', 'order_date', 'amount')->where('passport_code', $passport_code)->get();


                $i = 0;
                foreach ($items as $item) {
                    $order_data[$i]['order_date'] = date('d/m/Y', strtotime($item->order_date));
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


                return response()->json([
                    'success' => true,
                    'message' => 'Passport Order Detail',
                    'data' => $order_data
                ], Response::HTTP_OK);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }



    public function sendPassportOtp(Request $request)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
            $validator = Validator::make($request->all(), [
                'passport_code' => 'required',
                'total' => 'required',
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            // echo '<pre>user - '; print_r($user); die;
            $passportOrder = PassportOrder::where('user_id', $user->id)->where('passport_code', $request->passport_code)->first();

            if (!$passportOrder) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Passport.',
                ], 400);
            } else {

                if ($passportOrder->end_date < date('Y-m-d')) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Passport expired.',
                    ], 400);
                } elseif ($passportOrder->remaining_amount == 0) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Insufficient balance.',
                    ], 400);
                } else {
                    $phone = $passportOrder->User->phone;
                    $otp = rand(1111, 9999);

                    PassportOrder::where('passport_code', $request->passport_code)->update(array('otp' => $otp));

                    $message = $otp . ' is your OTP to login to Finch BrewCafe Account';
                    $this->sendMessage($phone, $message);

                    return response()->json([
                        'success' => true,
                        'message' => 'Otp send successfully on ' . $user->phone,
                        'data' => $otp
                    ], Response::HTTP_OK);
                }
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }

    public function passport_otp_verify(Request $request)
    {


        if ($user = JWTAuth::parseToken()->authenticate()) {
            $credentials = $request->only('phone');


            $validator = Validator::make($request->all(), [
                'passport_code' => 'required',
                'otp' => 'required',
                'total' => 'required'
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }
            // $usedPassport = PassportUsedOrder::where('passport_used_orders.passport_code',$request->passport_code)->select('passport_used_orders.*','passports.per_day_use')->leftJoin('passport_orders','passport_orders.passport_code','=','passport_used_orders.passport_code')->leftJoin('passports','passports.id','=','passport_orders.passport_id')->orderBy('passport_used_orders.id','DESC')->first();

            // $usedPassport = PassportUsedOrder::where('passport_used_orders.passport_code', $request->passport_code)->orderBy('passport_used_orders.id', 'DESC')->first();

            $passport_data = PassportOrder::where('passport_orders.passport_code', $request->passport_code)->select('passport_orders.*', 'passports.per_day_use')->leftJoin('passports', 'passports.id', '=', 'passport_orders.passport_id')->orderBy('passport_orders.id', 'DESC')->first();

            // $per_day_use = 0;
            // $today = date('d-m-y');
            // if ($usedPassport) {
            //     $useDate = date('d-m-y', strtotime($usedPassport->created_at));
            // }
            // echo '<pre>usedPassport - '; print_r($usedPassport->toArray()); die;

            // if ((isset($usedPassport) && !empty($usedPassport->toArray())) && $useDate == $today) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'This passport has been already used today.',
            //     ], 400);
            // }
            $ldate = date('Y-m-d');
            $used_Passport = PassportUsedOrder::where('passport_code',  $request->passport_code)->where('user_id', $user->id)->where(DB::raw('CAST(created_at as DATE)'), $ldate)->sum('amount');
            // $today = date('d-m-y');
            // if ($usedPassport) {
            //     $useDate = date('d-m-y', strtotime($usedPassport->created_at));
            // }

            if ($passport_data->per_day_use <= $used_Passport) {

                return response()->json([
                    'success' => 0,
                    'message' => "Your passport's daily limit is over",
                ]);
            }
            User::where('id', $user->id)->update([
                'passport_order' => $passport_data->id,
            ]);


            $passportOrder = PassportOrder::where('passport_code', $request->passport_code)->where('otp', $request->otp)->first();

            $per_day_use = $passport_data->per_day_use;

            if ($passportOrder) {
                $remaining_amount = $passportOrder->remaining_amount;

                $total = $request->total;

                $amount = 0;
                $passport_amount = $remaining_amount;

                if ($total > $remaining_amount) {

                    $ldate = date('Y-m-d');
                    $today_used_amount = PassportUsedOrder::where('passport_code', $passportOrder->passport_code)->where('user_id', $user->id)->where(DB::raw('CAST(created_at as DATE)'), $ldate)->sum('amount');

                    if (!empty($today_used_amount) && $today_used_amount != 0) {
                        $remaining_per_day_use = $per_day_use - $today_used_amount;

                        if ($total > $remaining_per_day_use) {
                            $t_total = $total - $remaining_per_day_use;

                            $passport_used_amount = $per_day_use - $today_used_amount;
                        } else {
                            $t_total = 0;
                            $passport_used_amount = $total;
                        }
                    } else {
                        if ($total > $per_day_use) {
                            $t_total = $total - $per_day_use;
                            $passport_used_amount = $per_day_use;
                        } else {
                            $t_total = 0;
                            $passport_used_amount = $total;
                        }
                    }

                    // $t_total = $total - ($total * $per_day_use / 100);

                    // $amount = $t_total;
                    // $passport_used_amount = ($total * $per_day_use / 100);
                    $passport_remaining_amount = 0;
                } else {

                    $ldate = date('Y-m-d');
                    $today_used_amount = PassportUsedOrder::where('passport_code', $passportOrder->passport_code)->where('user_id', $user->id)->where(DB::raw('CAST(created_at as DATE)'), $ldate)->sum('amount');

                    if (!empty($today_used_amount) && $today_used_amount != 0) {
                        $remaining_per_day_use = $per_day_use - $today_used_amount;

                        if ($total < $remaining_per_day_use) {
                            $t_total = 0;
                            $passport_used_amount = $total;
                        } else {
                            $t_total = $total - $remaining_per_day_use;
                            $passport_used_amount = $remaining_per_day_use;
                        }
                    } else {

                        if ($total < $per_day_use) {
                            $t_total = 0;
                            $passport_used_amount = $total;
                        } else {
                            $t_total = $total - $per_day_use;
                            $passport_used_amount = $per_day_use;
                        }
                    }


                    // $t_total = $total - ($total * $per_day_use / 100);
                    // $amount = $t_total;
                    // $passport_used_amount = ($total * $per_day_use / 100);
                    $passport_remaining_amount = $remaining_amount - $passport_used_amount;
                }


                if ($passport_used_amount > $remaining_amount) {
                    // $passport_used_amount = $remaining_amount;
                    // $amount = $total - $remaining_amount;
                    // $passport_remaining_amount = $remaining_amount - $remaining_amount;
                }
                $order_data = array();
                $order_data['passport_code'] = $request->passport_code;
                $order_data['total_pay'] = $t_total;
                $order_data['passport_used_amount'] = $passport_used_amount;
                $order_data['passport_remaining_amount'] = $passport_remaining_amount;

                // echo '<pre>';print_r($order_data);die;
                return response()->json([
                    'success' => true,
                    'message' => 'Final Order',
                    'data' => $order_data
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Otp.',
                ], 400);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid User.',
            ], 400);
        }
    }




    public function applyCoupon(Request $request)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
            $credentials = $request->only('phone');


            $validator = Validator::make($request->all(), [
                'coupon_code' => 'required',
                'total' => 'required'
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            $coupon = Coupon::where('discount_code', $request->coupon_code)->first();
            if ($coupon) {
                $discount = $coupon->discount;
                $total = $request->total;
                $new_total = round(($discount / 100) * $total);
                $coupon_amount = $new_total;
                $total_pay = $total - $new_total;
                $order_data = array();
                $order_data['coupon_code'] = $request->coupon_code;
                $order_data['total_pay'] = $total_pay;
                $order_data['coupon_percent'] = $discount;
                $order_data['coupon_amount'] = $coupon_amount;

                return response()->json([
                    'success' => true,
                    'message' => 'Final Order',
                    'data' => $order_data
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'invalid Coupon Code.',
                ], 400);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
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
