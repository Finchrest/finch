<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Passport;
use App\Models\PassportOrder;
use App\Models\GeneralSetting;
use App\Models\PassportOrderHistory;
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
            $name = $request->name;
            $phone = $request->phone;
            $email = $request->email;
        
            $order = PassportOrder::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'price'=>$passport->price,
                'passport_id'=>$passport_id,
                'status'=>0,
                'order_date'=>date('Y-m-d')
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order Created',
                'data' => array('order_id'=>$order->id,'price'=>$passport->price)
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

                $cheakOrder = PassportOrder::where(['id'=>$order_id,'status'=>1,'user_id'=>auth()->user()->id])->first();

                 $pay_data_hstry = array(
                    'passport_order_id' => $cheakOrder->id,
                    'user_id' => auth()->user()->id,
                    'name' => $cheakOrder->name,
                    'phone' => $cheakOrder->phone,
                    'email' => $cheakOrder->email,
                    'price'=>$cheakOrder->price,
                    'passport_id'=>$cheakOrder->passport_id,
                    'status'=>$cheakOrder->status,
                    'volume_amount'=>$volume,
                    'used_amount' => $cheakOrder->used_amount,
                    'remaining_amount' =>$volume,
                    'payment_id' => $payment_id,
                    'payment_date' => $cheakOrder->payment_date,
                    'pay_status' => $cheakOrder->pay_status,
                    'pay_res' => $cheakOrder->pay_res,
                    'order_date' => $cheakOrder->order_date,
                    'start_date' =>  $start_date,
                    'end_date' => $end_date,
                    'is_custom' => $cheakOrder->is_custom
                   
                );
                PassportOrderHistory::insert($pay_data_hstry);
        
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

    public function passportTopup(Request $request){
     
        if ($user = JWTAuth::parseToken()->authenticate()) {

       $validator =Validator::make($request->all(), [
            'pay_id' => 'required',
            'id'=>'required',
            'status'=>'required',
        ]);


        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }


        //    echo"a";die;
        $cheakOrder = PassportOrder::where(['id'=>$request->id,'status'=>1,'user_id'=>auth()->user()->id])->first();
        // echo '<pre>request - '; print_r($cheakOrder); die;

        if(empty($cheakOrder)){
             return response()->json([
                'error' => false,
                'message' => 'No Passport found.',
            ], 400);
        }

        $pay_data = array(
            'payment_id' => $request->pay_id,
            'payment_date' => date('Y-m-d'),
            'status' => 1,
            'pay_status' => $request->status,
        );
        $cheakOrder = PassportOrder::where(['id'=>$request->id,'status'=>1,'user_id'=>auth()->user()->id])->first();

      //echo"b";die;
      $passdata = Passport::where(['id'=>$cheakOrder->passport_id])->first();
      $bonus_amount = GeneralSetting::where('meta_key','top_up_benifit')->first();
      $amaunt_cal = PassportOrderHistory::where('passport_order_id',$request->id)->orderBy('created_at', 'DESC')->first();
     
        $total_amont_bonus = $amaunt_cal->remaining_amount + $bonus_amount->meta_value;
    //   echo"<pre> passdata -";print_r($passdata->);die;
         // echo"<pre> passdata -";print_r($total_amont_bonus);die;
      $start_date = date('Y-m-d');
      $end_date = date('Y-m-d', strtotime('+1 year'));

        $price = $passdata->price + $cheakOrder->price;
        $volume_amount =   $cheakOrder->volume_amount +  $total_amont_bonus;
        $remaining_amount =  $cheakOrder->remaining_amount +  $total_amont_bonus;


        $updata = array(
            'price' => $price,
            'volume_amount' => $volume_amount,
            'remaining_amount' => $remaining_amount,
        );

        PassportOrder::where(['id'=>$request->id])->update($updata);

        $pay_data_hstry = array(
            'passport_order_id' => $cheakOrder->id,
            'user_id' => auth()->user()->id,
            'name' => $cheakOrder->name,
            'phone' => $cheakOrder->phone,
            'email' => $cheakOrder->email,
            'price'=>$price,
            'passport_id'=>$cheakOrder->passport_id,
            'status'=>$cheakOrder->status,
            'volume_amount'=>$total_amont_bonus,
            'used_amount' => $cheakOrder->used_amount,
            'remaining_amount' => $total_amont_bonus,
            'payment_id' => $request->pay_id,
            'payment_date' => $cheakOrder->payment_date,
            'pay_status' => $cheakOrder->pay_status,
            'order_date' => $cheakOrder->order_date,
            'start_date' =>  $start_date,
            'end_date' => $end_date,
            'is_custom' => $cheakOrder->is_custom
           
        );
        PassportOrderHistory::insert($pay_data_hstry);
        

     
        return response()->json(['status' => 1,'msg' => 'Payment Success','id' => $request->id]);
      
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Topup Failed.',
            ], 400);
        }
    }   

}