<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Item;
use App\Models\Passport;
use App\Models\PassportOrder;
use App\Models\PassportUsedOrder;
use App\Models\GeneralSetting;
use App\Models\Coupon;
use App\Models\Place;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use DB;

class OrdersController extends Controller
{

    public function create_order(Request $request)
    {



        // file_put_contents('order_logs.txt', 'itemId-' . json_encode($productIdsWithZeroPrice) . PHP_EOL, FILE_APPEND | LOCK_EX);




        if ($user = JWTAuth::parseToken()->authenticate()) {

            if ($request->order_for == 2) {
                return $this->cartProcessTakewayOrder($request);
            }
            if ($request->order_for == 0) {
                return $this->cartProcessDeliveryOrder($request);
            }

            // vishal start today

            $itemData = $request->items;
            $data = json_decode($itemData, true);

            $productIdsWithZeroPrice = collect($data)->filter(function ($item) {
                return $item['price'] == 0.0;
            })->pluck('product_id')->toArray();


            $passport_data = PassportOrder::where('id', $user->passport_order)->first();

            if (!empty($user->passport_order) && $user->passport_order != 0) {

                $freeProduct = explode(',', $passport_data->is_free);
                $requestArray = array($productIdsWithZeroPrice);



                if (empty($passport_data->is_free)) {

                    $isFreeProduct =  $productIdsWithZeroPrice[0];
                } else {

                    $fProduct =  array_merge($freeProduct, $requestArray[0]);
                    $isFreeProduct = implode(',', $fProduct);
                }

                $order_data = array(
                    'is_free' => $isFreeProduct,
                );


                PassportOrder::where(['passport_code' => $passport_data->passport_code])->update($order_data);
            }

            // vishal end today


            $validator = Validator::make($request->all(), [
                'place_id' => 'required',
                'items' => 'required',
                'sub_total' => 'required',
                'total' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'city' => 'required',
                'qty' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            $place_id = $request->place_id;
            $items = $request->items;
            $name = $request->name;
            $phone = $request->phone;
            $address = $request->address;
            $city = $request->city;
            $total = $request->total;
            $sub_total = $request->sub_total;
            $qty = $request->qty;

            $item_arr = json_decode($items);

            $location = Place::where('id', $place_id)->first();

            $data['location'] = $loc = Location::where('status', 1)->where('id', $location->location)->first();
            $loctions_data = explode(',', $loc->allow_pincode);


            if ($request->order_for == 0) {
                if ($total <= $request->minimum_purchase_amount) {
                    $finalAmount = $total + $request->delivery_charges;
                    $dCharges = $request->delivery_charges;
                } else {
                    $finalAmount = $total;
                    $dCharges = '0.00';
                }
            } else {
                $finalAmount = $total;
                $dCharges = '0.00';
            }


            $order = Order::create([
                'user_id' => $user->id,
                'place_id' => $request->place_id,
                'location' => $location->location,
                'name' => $request->name,
                'phone' => $request->phone,
                'city' => $request->city,
                'sub_total' => $sub_total,
                'total' => $finalAmount,
                'qty' => $qty,
                'status' => 0,
                'order_for' => $request->order_for,
                'order_date' => date('Y-m-d'),
                'order_type' => $request->order_for
            ]);

            foreach ($item_arr as $item) {
                Item::create([
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'qty' => $item->qty,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'sub_total' => $item->sub_total,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order Created',
                'data' => array('order_id' => $order->id, 'dCharges' => $dCharges, 'total' => $finalAmount)
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }


    public function cartProcessTakewayOrder(Request $request)
    {


        if ($user = JWTAuth::parseToken()->authenticate()) {

            $validator = Validator::make($request->all(), [
                'place_id' => 'required',
                'items' => 'required',
                'sub_total' => 'required',
                'total' => 'required',
                'name' => 'required',
                'phone' => 'required',
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            $place_id = $request->place_id;
            $items = $request->items;
            $name = $request->name;
            $phone = $request->phone;

            $total = $request->total;
            $sub_total = $request->sub_total;
            $qty = $request->qty;

            $item_arr = json_decode($items);

            $location = Place::where('id', $place_id)->first();

            $data['location'] = $loc = Location::where('status', 1)->where('id', $location->location)->first();
            $loctions_data = explode(',', $loc->allow_pincode);

            if ($request->order_for == 0) {
                if ($total <= $request->minimum_purchase_amount) { //echo"a";die;
                    $finalAmount = $total + $request->delivery_charges;
                    $dCharges = $request->delivery_charges;
                } else {
                    $finalAmount = $total;
                    $dCharges = '0.00';
                }
            } else {
                $finalAmount = $total;
                $dCharges = '0.00';
            }



            $order = Order::create([
                'user_id' => $user->id,
                'place_id' => $request->place_id,
                'location' => $location->location,
                'name' => $request->name,
                'phone' => $request->phone,
                'sub_total' => $sub_total,
                'total' => $finalAmount,
                'qty' => $qty,
                'status' => 0,
                'order_for' => $request->order_for,
                'order_date' => date('Y-m-d'),
                'order_type' => $request->order_for

            ]);

            foreach ($item_arr as $item) {
                Item::create([
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'sub_total' => $item->sub_total,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order Created',
                'data' => array('order_id' => $order->id, 'dCharges' => $dCharges, 'total' => $finalAmount)
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }



    public function cartProcessDeliveryOrder(Request $request)
    {



        $user = JWTAuth::parseToken()->authenticate();
        $validator = Validator::make($request->all(), [
            'place_id' => 'required',
            'items' => 'required',
            'sub_total' => 'required',
            'total' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'qty' => 'required',
            'address' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $place_id = $request->place_id;
        $items = $request->items;
        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;
        $city = $request->city;
        $total = $request->total;
        $sub_total = $request->sub_total;
        $qty = $request->qty;

        $item_arr = json_decode($items);

        $location = Place::where('id', $place_id)->first();
        $data['location'] = $loc = Location::where('status', 1)->where('id', $location->location)->first();
        $loctions_data = explode(',', $loc->allow_pincode);

        if (in_array($request->pincode, $loctions_data)) {

            if ($request->order_for == 0) {
                if ($total <= $request->minimum_purchase_amount) { //echo"a";die;
                    $finalAmount = $total + $request->delivery_charges;
                    $dCharges = $request->delivery_charges;
                } else {
                    $finalAmount = $total;
                    $dCharges = '0.00';
                }
            } else {
                $finalAmount = $total;
                $dCharges = '0.00';
            }

            $dtax = '0.00';
            $minimum_purchase_amount = GeneralSetting::select('meta_value')->where('meta_key', 'minimum_purchase_amount')->first();
            $delivery_charges = GeneralSetting::select('meta_value')->where('meta_key', 'delivery_charges')->first();
            $delivery_tax = GeneralSetting::select('meta_value')->where('meta_key', 'deliveryTax')->first();

            if ($finalAmount <= $minimum_purchase_amount['meta_value']) { //echo"a";die;
                $dtax = $delivery_tax['meta_value'];
                $dCharges = $delivery_charges['meta_value'];
            }

            $order = Order::create([
                'user_id' => $user->id,
                'place_id' => $request->place_id,
                'location' => $location->location,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                // 'state' => $request->state,
                'city' => $request->city,
                'sub_total' => $sub_total,
                'total' => $finalAmount,
                'qty' => $qty,
                'status' => 0,
                'order_for' => $request->order_for,
                'order_date' => date('Y-m-d'),
                'order_type' => $request->order_for,
                'delivery_charge' =>  $dCharges,
                'delivery_tax' => $dtax,
            ]);

            foreach ($item_arr as $item) {
                Item::create([
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'qty' => $item->qty,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'sub_total' => $item->sub_total,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order Created',
                'data' => array('order_id' => $order->id, 'dCharges' => $dCharges, 'delivery_tax' => $dtax, 'total' => $finalAmount)
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Over Location Is not able to shipping order on your pincode location',
            ], Response::HTTP_OK);
        }
    }

    public function getDeliveryCharges()
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
            $minimum_purchase_amount = GeneralSetting::select('meta_value')->where('meta_key', 'minimum_purchase_amount')->first();
            $delivery_charges = GeneralSetting::select('meta_value')->where('meta_key', 'delivery_charges')->first();
            $delivery_tax = GeneralSetting::select('meta_value')->where('meta_key', 'deliveryTax')->first();

            // echo "<pre>";print_r($delivery_tax);die;
            return response()->json([
                'success' => true,
                'message' => 'Delivery Charges',
                'data' => array('minimum_purchase_amount' => $minimum_purchase_amount['meta_value'], 'delivery_charges' => $delivery_charges['meta_value'], 'delivery_tax' => $delivery_tax['meta_value'])
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }



    public function order_confirm(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all()); die;

        if ($user = JWTAuth::parseToken()->authenticate()) {
            $validator = Validator::make($request->all(), [
                'type' => 'required',
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            if ($request->type == 1) {
                $validator = Validator::make($request->all(), [
                    'order_id' => 'required',
                    'payment_id' => 'required',
                ]);
            }

            if ($request->type == 2) {
                $validator = Validator::make($request->all(), [
                    'order_id' => 'required',
                    'payment_id' => 'required',
                    'passport_code' => 'required',
                ]);
            }

            if ($request->type == 3) {
                $validator = Validator::make($request->all(), [
                    'order_id' => 'required',
                    'passport_code' => 'required',
                ]);
            }

            if ($request->type == 4) {
                $validator = Validator::make($request->all(), [
                    'order_id' => 'required',
                    'payment_id' => 'required',
                    'coupon_code' => 'required',
                ]);
            }

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            $payment_id = $passport_code = $coupon_code = '';
            $passport_pay = $coupon_percent = $coupon_amount = $discount = 0;
            $order_id = $request->order_id;
            $type = $request->type;



            $payment_date = date('Y-m-d');

            $order = Order::where('id', $order_id)->where('user_id', $user->id)->where('status', 0)->first();
            // echo '<pre>'; print_r($order->toArray()); die;

            if (!$order) {


                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Order.',
                ], 400);
            } else {
                $total_pay = $total = $order->total;
                if ($type == 1) {
                    $payment_id = $request->payment_id;
                }

                if ($type == 2 || $type == 3) {
                    if ($type == 2) {
                        $payment_id = $request->payment_id;
                    }
                    $passport_code = $request->passport_code;


                    $passportOrder = PassportOrder::where('passport_code', $passport_code)->first();
                    if (!$passportOrder) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Invalid Passport Code.',
                        ], 400);
                    }

                    $passport = Passport::where('id', $passportOrder->passport_id)->first();


                    $remaining_amount = $passportOrder->remaining_amount;
                    $used_amount = $passportOrder->used_amount;
                    $per_day_use = 0;

                    if (!empty($passport->per_day_use)) {
                        $per_day_use = $passport->per_day_use;
                    }

                    if ($total > $remaining_amount) {


                        $ldate = date('Y-m-d');
                        $today_used_amount = PassportUsedOrder::where('passport_code', $passportOrder->passport_code)->where('user_id', $user->id)->where(DB::raw('CAST(created_at as DATE)'), $ldate)->sum('amount');


                        if (!empty($today_used_amount) && $today_used_amount != 0) {
                            $remaining_per_day_use = $per_day_use - $today_used_amount;

                            if ($total > $remaining_per_day_use) {
                                $total_pay = $total - $remaining_per_day_use;
                                $passport_pay = $per_day_use - $today_used_amount;
                            } else {
                                $total_pay = 0;
                                $passport_pay = $total;
                            }
                        } else {
                            if ($total > $per_day_use) {
                                $total_pay = $total - $per_day_use;
                                $passport_pay = $per_day_use;
                            } else {
                                $total_pay = 0;
                                $passport_pay = $total;
                            }
                        }

                        $passport_amount = 0;
                        $used_amount = $used_amount + $passport_pay;
                        // $passport_pay = $total_pay;
                        $remaining_amount = 0;
                    } else {

                        $ldate = date('Y-m-d');
                        $today_used_amount = PassportUsedOrder::where('passport_code', $passportOrder->passport_code)->where('user_id', $user->id)->where(DB::raw('CAST(created_at as DATE)'), $ldate)->sum('amount');


                        if (!empty($today_used_amount) && $today_used_amount != 0) {
                            $remaining_per_day_use = $per_day_use - $today_used_amount;

                            if ($total < $remaining_per_day_use) {
                                $total_pay = 0;
                                $passport_pay = $total;
                            } else {
                                $total_pay = $total - $remaining_per_day_use;
                                $passport_pay = $remaining_per_day_use;
                            }
                        } else {
                            if ($total < $per_day_use) {
                                $total_pay = 0;
                                $passport_pay = $total;
                            } else {
                                $total_pay = $total - $per_day_use;
                                $passport_pay = $per_day_use;
                            }
                        }


                        $passport_amount = $remaining_amount - $total;
                        $used_amount = $passportOrder->used_amount + $passport_pay;
                        $remaining_amount = $remaining_amount - $total;
                    }

                    if ($passport_pay > $passportOrder->remaining_amount) {
                        // $passport_pay = $passportOrder->remaining_amount;
                        // $total_pay = $total - $passportOrder->remaining_amount;
                        $used_amount = $passportOrder->used_amount + $passportOrder->remaining_amount;
                        $remaining_amount = $passportOrder->remaining_amount - $passportOrder->remaining_amount;
                    }
                    // echo "used amount=".$used_amount."remaning amount=".$remaining_amount."passport_pay=".$passport_pay."total_pay=".$total_pay;die;

                    if ($passportOrder->remaining_amount > 0) {
                        PassportOrder::where('passport_code', $passport_code)->update(array('used_amount' => $used_amount, 'remaining_amount' => $remaining_amount));

                        PassportUsedOrder::create([
                            'user_id' => $user->id,
                            'order_id' => $order_id,
                            'passport_code' => $passport_code,
                            'order_type' => 1,
                            'amount' => $passport_pay,
                            'order_date' => time()
                        ]);
                    }
                }

                if ($type == 4) {
                    $payment_id = $request->payment_id;
                    $coupon = Coupon::where('discount_code', $request->coupon_code)->first();
                    if (!$coupon) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Invalid Coupon Code.',
                        ], 400);
                    }


                    $p = Coupon::where('discount_code', $request->coupon_code);
                    $p->whereRaw("find_in_set('$order->location',locations) > 0");
                    $c_loc = $p->first();

                    // echo "<pre>coupon $order->location - "; print_r($c_loc->toArray()); //die;
                    // $c_loc = explode(',',$coupon->locations);

                    if (!$c_loc) {
                        return response()->json([
                            'success' => false,
                            'message' => 'This coupon code is not applied for this location.',
                        ], 400);
                    }

                    $coupon_code = $request->coupon_code;
                    $discount = $coupon->discount;
                    $new_total = round(($discount / 100) * $total);
                    $coupon_amount = $new_total;
                    $total_pay = $total - $new_total;
                }



                $obj = Order::firstOrNew(['id' => $order_id]);
                $obj->payment_date = $payment_date;
                $obj->payment_id = $payment_id;
                $obj->passport_code = $passport_code;
                $obj->passport_pay = $passport_pay;
                $obj->total_pay = $total_pay;
                $obj->order_for = $request->order_for;
                $obj->coupon_code = $coupon_code;
                $obj->coupon_percent = $discount;
                $obj->coupon_amount = $coupon_amount;
                $obj->type = $type;
                $obj->status = 1;
                $obj->save();

                $check_order = Order::where(['id' =>  $order_id])->first();

                $place_data = Place::where('id', $check_order->place_id)->first();
                $user_data = User::where('id', $check_order->user_id)->first();
                $phone = $user_data->phone;
                $place_name = $place_data->name;

                sendNotification('Order Send', 'Your Order has been requested at the Restaurant ' . $place_name . '', '', 'user_' . $phone . '');
                return response()->json([
                    'success' => true,
                    'message' => 'Payment Success',
                ], Response::HTTP_OK);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }
}
