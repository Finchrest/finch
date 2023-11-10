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
use App\Models\Coupon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use DB;
use Helper;

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
        $otp=rand(1111,9999);
        //Request is valid, create new user
        $user = User::create([
        	'name' => $request->name,
        	'email' => $request->email,
        	'phone' => $request->phone,
            'otp'=>$otp
        ]);

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

        $data = $request->only('phone','otp');
        $validator = Validator::make($data, [
            'phone' => 'required',
            'otp' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $user = User::select('id','name','email','phone','is_new')->where('phone',$request->phone)->where('otp',$request->otp)->first();
        if($user){
            try {
            if (! $token = JWTAuth::fromUser($user)) {
               
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }else{
                 User::where('phone',$request->phone)->update(array('otp'=>''));
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
                'userInfo'=>$user
            ], Response::HTTP_OK);
        }else{
             return response()->json([
                	'success' => false,
                	'message' => 'invalid Otp.',
                ], 400);
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
        
        $user = User::where('phone',$request->phone)->first();
        if(!$user){
            return response()->json([
                	'success' => false,
                	'message' => 'invalid User.',
                ], 400);
        }else{
            $otp=rand(1111,9999);
            User::where('phone',$request->phone)->update(array('otp'=>$otp));
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

        //valid credential
        $validator = Validator::make($credentials, [
            'phone' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $user = User::where('phone',$request->phone)->orWhere('email',$request->phone)->first();
        $otp=rand(1111,9999);
        if(!$user){
           if (is_numeric($request->phone)){
                $user = User::create([
                    'phone' => $request->phone,
                    'otp'=>$otp
                ]);
            }else{
                 return response()->json([
                	'success' => false,
                	'message' => 'You need register with phone number',
                ], 400);
            }
            
        }
           
            User::where('id',$user->id)->update(array('otp'=>$otp));
			$message = $otp.' is your OTP to login to Finch Account.';

            $this->sendMessage($request->phone, $message);
            return response()->json([
                'success' => true,
                'message' => 'Otp send successfully on '.$user->phone,
                'data' => $otp
             ], Response::HTTP_OK);
        
        
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
           
            $uinfo = User::select('id','name','email','phone')->where('id',$user->id)->first();
            return response()->json([
                'success' => true,
                'message' => 'User Info',
                'userInfo'=>$uinfo
            ], Response::HTTP_OK);
        }else{
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
                'email'=> 'required|email|unique:users,email,'.$user->id,
                'phone' => 'required|min:11|numeric|unique:users,phone,'.$user->id,
            ]);

        //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            $uarray =array(
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'is_new'=>1
            ); 

            User::where('id', $user->id)->update($uarray);
            $uinfo = User::select('id','name','email','phone','is_new')->where('id',$user->id)->first();
            return response()->json([
                'success' => true,
                'message' => 'User Info Update Successfully',
                'userInfo'=>$uinfo
            ], Response::HTTP_OK);
        }else{
         return response()->json([
                	'success' => false,
                	'message' => 'invalid User.',
                ], 400);
        }
      
    }


    public function check_token(Request $request)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
           
            $uinfo = User::select('id','name','email','phone')->where('id',$user->id)->first();
            return response()->json([
                'success' => true,
                'message' => 'User Info',
                'userInfo'=>$uinfo
            ], Response::HTTP_OK);
        }else{
         return response()->json([
                	'success' => false,
                	'message' => 'invalid User.',
                ], 400);
        }
      
    }


    public function get_user_order(Request $request)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
    	    $product_arr =array();
            $orders = Order::select('id','name','phone','address','total','sub_total','qty','payment_id','order_date','payment_date')->where('status',1)->where('user_id',$user->id)->get();
        
             return response()->json([
                    'success' => true,
                    'message' => 'My orders',
                    'data'=>$orders
                ], Response::HTTP_OK);
         }else{
         return response()->json([
                	'success' => false,
                	'message' => 'invalid User.',
                ], 400);
        }
    }


    public function order_detail(Request $request,$id)
    {
        
        if ($user = JWTAuth::parseToken()->authenticate()) {
    	    $product_arr =array();
            $order = Order::select('id','name','phone','address','total','sub_total','qty','payment_id','order_date','payment_date')->where('id',$id)->first()->toArray();
            if(!$order){
               
                return response()->json([
                	'success' => false,
                	'message' => 'invalid Order.',
                ], 400);
            }else{
             $order_data=array();
             $order_data['order'] = $order;
            
                $p = Item::select('items.id','items.product_id','items.price','items.sub_total','items.qty');
                $p->where('items.order_id',$id);
                $items = $p->get()->toArray();
                $i=0;
                foreach($items as $item){  
                    $order_data['order']['items'][$i]=$item;
                    $order_data['order']['items'][$i]['product']=$this->getProductDetail($item['product_id']);
                $i++;
                }

            

             return response()->json([
                    'success' => true,
                    'message' => 'Order Detail',
                    'data'=>$order_data
                ], Response::HTTP_OK);
            }
         }else{
         return response()->json([
                	'success' => false,
                	'message' => 'invalid User.',
                ], 400);
        }
    }


    public function getProductDetail($id){
        $product_arr =array();
        $product = Product::find($id);

        $product_arr=$product; 
        $product_arr['image']=asset($product->FileId->file); 
        $product_arr['type_name']=$product->Type->name; 
        $product_arr['category_name']=$product->Category->name; 
        $product_arr['place_name']=$product->Place->name; 
        $product_arr['location_name']=$product->Place->Location->name; 
       
         if($product->type ==1){
                $product_arr['malts']=get_malt_explode($product->malt); 
                $product_arr['hops']=get_hop_explode($product->hops); 
            }else{
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



    public function get_user_passport_order(Request $request)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
    	    $product_arr =array();
            $orders = PassportOrder::select('id','passport_code','passport_id','name','phone','email','price','payment_id','order_date','payment_date','volume_amount','used_amount','remaining_amount','start_date','end_date')->where('status',1)->where('user_id',$user->id)->get();
        
             return response()->json([
                    'success' => true,
                    'message' => 'My Passport orders',
                    'data'=>$orders
                ], Response::HTTP_OK);
         }else{
         return response()->json([
                	'success' => false,
                	'message' => 'invalid User.',
                ], 400);
        }
    }


    public function passport_order_detail(Request $request,$id)
    {
        
        if ($user = JWTAuth::parseToken()->authenticate()) {
    	    $product_arr =array();
            $passportOrder = PassportOrder::select('passport_code')->where('id',$id)->first();
            if(!$passportOrder){
               
                return response()->json([
                	'success' => false,
                	'message' => 'invalid Order.',
                ], 400);
            }else{
            
             $order_data=array();
             $passport_code =$passportOrder['passport_code'];
             $items = PassportUsedOrder::select('order_type','order_date','amount')->where('passport_code',$passport_code)->get(); 
            
             
             $i=0;      
              foreach($items as $item){    
                   $order_data[$i]['order_date']=date('d/m/Y',strtotime($item->order_date));
                    $order_data[$i]['amount']=$item->amount;
                    $order_type='Direct';
                    if($item->order_type == 1){
                        $order_type='Online order';
                    }
					if($item->order_type == 2){
                        $order_type='Custom order';
                    }
                    $order_data[$i]['order_type']=$order_type;

                $i++;
                }


             return response()->json([
                    'success' => true,
                    'message' => 'Passport Order Detail',
                    'data'=>$order_data
                ], Response::HTTP_OK);
            }
         }else{
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
                'total'=>'required',
            ]);

        //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }


           $passportOrder = PassportOrder::where('user_id',$user->id)->where('passport_code',$request->passport_code)->first();

           if(!$passportOrder){
                return response()->json([
                	'success' => false,
                	'message' => 'invalid Passport.',
                ], 400);
           }else{

               if($passportOrder->end_date < date('Y-m-d')){
                     return response()->json([
                	    'success' => false,
                	    'message' => 'Passport expired.',
                    ], 400);
               }elseif($passportOrder->remaining_amount ==0){
                     return response()->json([
                	    'success' => false,
                	    'message' => 'Insufficient balance.',
                    ], 400);
               }else{
                    $phone = $passportOrder->User->phone;
                    $otp=rand(1111,9999);

                    PassportOrder::where('passport_code',$request->passport_code)->update(array('otp'=>$otp));
                    return response()->json([
                        'success' => true,
                        'message' => 'Otp send successfully on '.$user->phone,
                        'data' => $otp
                    ], Response::HTTP_OK);
               }

           }

        }else{
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
            'total'=>'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        $usedPassport = PassportUsedOrder::where('passport_used_orders.passport_code',$request->passport_code)->select('passport_used_orders.*','passports.per_day_use')->leftJoin('passport_orders','passport_orders.passport_code','=','passport_used_orders.passport_code')->leftJoin('passports','passports.id','=','passport_orders.passport_id')->orderBy('passport_used_orders.id','DESC')->first();
        
        $today = date('d-m-y');
        $useDate = date('d-m-y',strtotime($usedPassport->created_at));
        // echo '<pre>usedPassport - '; print_r($usedPassport->toArray()); die;

        if((isset($usedPassport) && !empty($usedPassport->toArray())) && $useDate == $today){
            return response()->json([
                'success' => false,
                'message' => 'This passport has been already used today.',
            ], 400);
        }

        $passportOrder = PassportOrder::where('passport_code',$request->passport_code)->where('otp',$request->otp)->first();
        

        if($passportOrder){
            $remaining_amount = $passportOrder->remaining_amount;

            $total = $request->total;

            $amount = 0; 
            $passport_amount = $remaining_amount;
            if($total > $remaining_amount){
                $t_total = $total - ($total * $usedPassport->per_day_use/100);
                $amount = $t_total - $remaining_amount;
                $passport_amount = 0;
            }else{
                $amount = 0;
                $passport_amount = $remaining_amount-$total;
            }

            $order_data=array();
            $order_data['passport_code']=$request->passport_code;
            $order_data['total_pay']=$amount;
            $order_data['passport_amount']=$passport_amount;

            return response()->json([
                        'success' => true,
                        'message' => 'Final Order',
                        'data' => $order_data
                    ], Response::HTTP_OK);
           
        }else{
             return response()->json([
                	'success' => false,
                	'message' => 'invalid Otp.',
                ], 400);
        }
    }else{
        return response()->json([
                	'success' => false,
                	'message' => 'invalid User.',
                ], 400);
    }
       
    }




    public function applyCoupon(Request $request)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
    	$credentials = $request->only('phone');

       
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required',
            'total'=>'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $coupon = Coupon::where('discount_code',$request->coupon_code)->first();
        if($coupon){
            $discount = $coupon->discount;
            $total = $request->total;
            $new_total = round(($discount / 100) * $total);
            $coupon_amount = $new_total;
            $total_pay = $total-$new_total;
            $order_data=array();
            $order_data['coupon_code']=$request->coupon_code;
            $order_data['total_pay']=$total_pay;
            $order_data['coupon_percent']=$discount;
            $order_data['coupon_amount']=$coupon_amount;

            return response()->json([
                        'success' => true,
                        'message' => 'Final Order',
                        'data' => $order_data
                    ], Response::HTTP_OK);
           
        }else{
             return response()->json([
                	'success' => false,
                	'message' => 'invalid Coupon Code.',
                ], 400);
        }
    }else{
        return response()->json([
                	'success' => false,
                	'message' => 'invalid User.',
                ], 400);
    }
       
    }
	
	
    public function sendMessage($mobile, $message){
        // echo $mobile.' - '.$message; die;
        if(isset($_POST['submit1'])){
            $user = "20101182";
            $pwd= "sms@2021";
            $senderid = "FINCHH";
            $CountryCode = "+91";
            $mobileno = $mobile;
            $msgtext = $message;
            $tpid = "1307160941407";
            $peid = "1301160275836879587";
        // $url = 'http://bulk.tekunik.in/api/mt/SendSMS?user='.$user.'&password='.$password.'&senderid='.$senderid.'&channel='.$channel.'&DCS='.$DCS.'&flashsms='.$flashsms.'&number='.$number.'&text='.$message.'&route='.$route.'&DLTTemplateId='.$tpid.'&peid='.$peid.'';
        
        // $url = "http://www.viewtechsms.com/sendurlcomma.aspx?user=profileid&pwd=xxxx&senderid=ABC&CountryCode=91&mobileno=9911111111&msgtext=Hello";
        $ch = curl_init();
        
            $url = "http://www.viewtechsms.com/sendurlcomma.aspx";
            $dataArray = array(
                'user' => $user,
                'pwd'=>$pwd,
                'senderid' => $senderid,
                'CountryCode' => $CountryCode,
                'mobileno' => $mobileno,
                'msgtext' => $msgtext,
                'tpid' => $tpid,
                'peid' => $peid,
            );
            $data = http_build_query($dataArray);
            $getUrl = $url."?".$data;
            //echo $getUrl;die;
        
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_URL, $getUrl);
            curl_setopt($ch, CURLOPT_TIMEOUT, 80);
            
            $response = curl_exec($ch);
            //echo '<pre>';print_r($response);die;  
            if(curl_error($ch)){
                echo 'Request Error:' . curl_error($ch);
            }else{
                // echo '<pre>';print_r($response);die;  
                echo $response;
            }     
            curl_close($ch);
        }
    }
	
}