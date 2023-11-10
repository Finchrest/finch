<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Item;
use App\Models\Passport;
use App\Models\PassportOrder;
use App\Models\PassportUsedOrder;
use App\Models\Coupon;
use App\Models\Place;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class OrdersController extends Controller
{
   
    public function create_order(Request $request)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
       
        $validator =Validator::make($request->all(), [
            'place_id' => 'required',
            'items' => 'required',
            'sub_total'=>'required',
            'total'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'state'=>'required',
            'city'=>'required',
            'qty'=>'required',
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
        $state = $request->state;
        $city = $request->city;
        $total = $request->total;
        $sub_total = $request->sub_total;
        $qty = $request->qty;

        $item_arr = json_decode($items);
        
        $location = Place::where('id',$place_id)->first();
        
        $order = Order::create([
            'user_id' => $user->id,
            'place_id' => $request->place_id,
            'location' => $location->location,
        	'name' => $request->name,
        	'phone' => $request->phone,
        	'address' => $request->address,
        	'state' => $request->state,
        	'city' => $request->city,
            'sub_total'=>$sub_total,
            'total'=>$total,
            'qty'=>$qty,
            'status'=>0,
            'order_date'=>date('Y-m-d')
        ]);

        foreach($item_arr as $item){
            Item::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'qty' => $item->qty,
                'price'=>$item->price,
                'sub_total'=>$item->sub_total,
            ]);
        }    

    	 return response()->json([
            'success' => true,
            'message' => 'Order Created',
            'data' => array('order_id'=>$order->id,'total'=>$total)
        ], Response::HTTP_OK);
        

       
        }else{
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
       $validator =Validator::make($request->all(), [
            'type' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        if($request->type == 1){    
            $validator =Validator::make($request->all(), [
                'order_id' => 'required',
                'payment_id'=>'required',
            ]);
        }

        if($request->type == 2){    
            $validator =Validator::make($request->all(), [
                'order_id' => 'required',
                'payment_id'=>'required',
                'passport_code'=>'required',
            ]);
        }

        if($request->type == 3){    
            $validator =Validator::make($request->all(), [
                'order_id' => 'required',
                'passport_code'=>'required',
            ]);
        }

        if($request->type == 4){    
            $validator =Validator::make($request->all(), [
                'order_id' => 'required',
                'payment_id'=>'required',
                'coupon_code'=>'required',
            ]);
        }

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $payment_id =$passport_code =$coupon_code='';
        $passport_pay=$coupon_percent=$coupon_amount=$discount=0;
        $order_id = $request->order_id;
        $type = $request->type;
        
       
        
        $payment_date = date('Y-m-d');
        
		$order = Order::where('id',$order_id)->where('user_id',$user->id)->where('status',0)->first();
        // echo '<pre>'; print_r($order->toArray()); die;
		 
        if(!$order){
         
        
             return response()->json([
                        'success' => false,
                        'message' => 'Invalid Order.',
                    ], 400);
         }else{
            $total_pay = $total = $order->total;
            if($type == 1){
                $payment_id = $request->payment_id;
                
            }

            if($type == 2 || $type == 3){
                if($type == 2){
                    $payment_id = $request->payment_id;
                }
                $passport_code = $request->passport_code;
                

                $passportOrder = PassportOrder::where('passport_code',$passport_code)->first();
                if(!$passportOrder){
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid Passport Code.',
                    ], 400);
                }

                $passport = Passport::where('id',$passportOrder->passport_id)->first();
                
                if($passport->location != $order->location){
                    return response()->json([
                        'success' => false,
                        'message' => 'This passport is not valid for this location.',
                    ], 400);
                }

                $remaining_amount = $passportOrder->remaining_amount;
                $used_amount = $passportOrder->used_amount;
                $per_day_use = 0;

                if(!empty($passport->per_day_use)){
                    $per_day_use = $passport->per_day_use;
                }

                if($total > $remaining_amount){
                    // echo 'if'; die;
                     $total_pay = $total -  ($total * $per_day_use/100);
                     $passport_amount = 0;
                     $used_amount = $used_amount + ($total * $per_day_use/100);
                     $passport_pay = ($total * $per_day_use/100);
                     $remaining_amount = $remaining_amount - ($total * $per_day_use/100);
                    
                }else{
                    $total_pay = $total -  ($total * $per_day_use/100);
                    $passport_amount = $remaining_amount-$total;
                    $used_amount = $used_amount + ($total * $per_day_use/100);
                    $passport_pay = ($total * $per_day_use/100);
                    $remaining_amount = $remaining_amount - ($total * $per_day_use/100);
                     
                }
                
                if($passport_pay > $passportOrder->remaining_amount){
                    $passport_pay = $passportOrder->remaining_amount;
                    $total_pay = $total - $passportOrder->remaining_amount;
                    $used_amount = $passportOrder->used_amount + $passportOrder->remaining_amount;
                    $remaining_amount = $passportOrder->remaining_amount - $passportOrder->remaining_amount;
                }

                // echo '<pre>passportOrder - '; print_r($passportOrder->toArray()); die;
                if($passportOrder->remaining_amount > 0){
                    PassportOrder::where('passport_code',$passport_code)->update(array('used_amount'=>$used_amount,'remaining_amount'=>$remaining_amount));
                    
                    PassportUsedOrder::create([
                            'user_id' => $user->id,
                            'order_id' => $order_id,
                            'passport_code' => $passport_code,
                            'order_type' => 1,
                            'amount' => $passport_pay,
                            'order_date'=>time()
                        ]);
                }

            }

            if($type == 4){
                $payment_id = $request->payment_id;
                $coupon = Coupon::where('discount_code',$request->coupon_code)->first();
                if(!$coupon){
                     return response()->json([
                        'success' => false,
                        'message' => 'Invalid Coupon Code.',
                    ], 400);
                }

                
                $p = Coupon::where('discount_code',$request->coupon_code);
                $p->whereRaw("find_in_set('$order->location',locations) > 0");
                $c_loc = $p->first();
				
				// echo "<pre>coupon $order->location - "; print_r($c_loc->toArray()); //die;
                // $c_loc = explode(',',$coupon->locations);
				
                if(!$c_loc){
                    return response()->json([
                        'success' => false,
                        'message' => 'This coupon code is not applied for this location.',
                    ], 400);
                }
				
                $coupon_code = $request->coupon_code;
                $discount = $coupon->discount;
                $new_total = round(($discount / 100) * $total);
                $coupon_amount = $new_total;
                $total_pay = $total-$new_total;
            }

             $obj = Order::firstOrNew(['id' =>$order_id]);
                $obj->payment_date = $payment_date;
                $obj->payment_id = $payment_id;
                $obj->passport_code = $passport_code;
                $obj->passport_pay = $passport_pay;
                $obj->total_pay = $total_pay;
                $obj->coupon_code = $coupon_code;
                $obj->coupon_percent = $discount;
                $obj->coupon_amount = $coupon_amount;
                $obj->type = $type;
                $obj->status = 1;
                $obj->save();
        
                return response()->json([
                    'success' => true,
                    'message' => 'Payment Success',
                ], Response::HTTP_OK);
        }

       
        }else{
            return response()->json([
                        'success' => false,
                        'message' => 'invalid User.',
                    ], 400);
        }
    }

}