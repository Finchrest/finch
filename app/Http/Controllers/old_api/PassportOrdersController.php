<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Passport;
use App\Models\PassportOrder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Helper;

class PassportOrdersController extends Controller
{
   
    public function create_passport_order(Request $request)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
       
        $validator =Validator::make($request->all(), [
            'passport_id' => 'required',
            'price'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $passport_id = $request->passport_id;
        $passport = Passport::where('id',$passport_id)->first();
        if(!$passport){
            return response()->json([
                        'success' => false,
                        'message' => 'invalid Passport.',
                    ], 400);
        
        }else{
            $price = $request->price;
            $name = $request->name;
            $phone = $request->phone;
            $email = $request->email;
        
            $order = PassportOrder::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'price'=>$price,
                'passport_id'=>$passport_id,
                'status'=>0,
                'order_date'=>date('Y-m-d')
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order Created',
                'data' => array('order_id'=>$order->id,'price'=>$price)
            ], Response::HTTP_OK);
            
        }
       
        }else{
            return response()->json([
                        'success' => false,
                        'message' => 'invalid User.',
                    ], 400);
        }
    }


    public function passport_order_confirm(Request $request)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
       
        $validator =Validator::make($request->all(), [
            'order_id' => 'required',
            'payment_id'=>'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $order_id = $request->order_id;
         
        $payment_id = $request->payment_id;
        $payment_date = date('Y-m-d');
        
         $order = PassportOrder::where('id',$order_id)->where('user_id',$user->id)->where('status',0)->first();
        
         if(!$order){
         
        
             return response()->json([
                        'success' => false,
                        'message' => 'invalid Order.',
                    ], 400);
         }else{

            $passport = Passport::where('id',$order->passport_id)->first();
            $volume = $remaining_amount = $passport->volume;
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d', strtotime('+1 year'));

             $passport_code = generatePassportCode();
              $obj = PassportOrder::firstOrNew(['id' =>$order_id]);
                $obj->payment_date = $payment_date;
                $obj->payment_id = $payment_id;
                $obj->passport_code = $passport_code;
                $obj->volume_amount = $volume;
                $obj->remaining_amount = $remaining_amount;
                $obj->start_date = $start_date;
                $obj->end_date = $end_date;
                $obj->status = 1;
                $obj->save();

                $pass_arr=array();
                $passport_data=PassportOrder::firstOrNew(['id' =>$order_id]);

                $pass_arr['passport_code']=$passport_data->passport_code;
                $pass_arr['phone']=$passport_data->User->phone;
                $pass_arr['email']=$passport_data->User->email;
                $pass_arr['price']=$passport_data->price;
                $pass_arr['volume']=$passport_data->volume_amount;
                $pass_arr['validity']=$passport_data->start_date.' - '.$passport_data->end_date;
        
                return response()->json([
                    'success' => true,
                    'message' => 'Payment Success',
                    'passport_code' => $pass_arr,
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