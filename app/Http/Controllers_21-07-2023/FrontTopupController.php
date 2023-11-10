<?php

namespace App\Http\Controllers;


use App\Models\Banner;
use App\Models\Place;
use App\Models\Product;
use App\Models\Location;
use App\Models\PassportPage;
use App\Models\Passport;
use App\Models\PassportOrder;
use App\Models\PassportOrderHistory;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Razorpay\Api\Api;
use Session;
use Exception;
use Cart;

class FrontTopupController extends Controller
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
        
        // echo '<pre>user - '; print_r($user); die;
        // return view('home',$data);
    }

    public function showTopUpPage(Request $request)
    {
        // echo"a";die;
        //  echo '<pre>data - '; print_r($data['product']->toArray()); die;
        $data['order_id'] = $request->order_id;
        if(!empty(auth()->user()->id)){
            $view = view('front/topup/passport_view',$data);
            return response()->json(['success'=>1,'view'=>$view->render()]);
        }else{
            return response()->json(['success'=>0,'message'=>'Please login first!!']);
        }
        
    }

    public function getTopUpView(Request $request)
    {

        $pass = Passport::where(['passport_orders.id'=>$request->order_id,'passport_orders.user_id'=>auth()->user()->id])->select('passports.*','passport_orders.id as pass_id','passport_orders.name as pass_name','passport_orders.phone as pass_phone','passport_orders.email as pass_email')->leftjoin('passport_orders', 'passport_orders.passport_id', '=', 'passports.id')->first();

        // dd($pass);

        // echo"<pre>";print_r($pass->toArray());die;

        if($pass){
           // $pass->image=asset($pass->FileId->file); 
            $data['passport'] = $pass;
            $view = view('front/topup/get_passport_view',$data);
            return response()->json(['success'=>1,'view'=>$view->render()]);
        }else{
            return response()->json(['success'=>0,'message'=>'Passport not available on selected location.']);
        }
        
    }

    public function getTopUpViewcustomer(Request $request)
    {
// echo"<pre>";print_r($request->all());die;
        $pass = Passport::where(['passport_orders.id'=>$request->order_id,'passport_orders.user_id'=>auth()->user()->id])->select('passports.*','passport_orders.id as pass_id','passport_orders.name as pass_name','passport_orders.phone as pass_phone','passport_orders.email as pass_email')->leftjoin('passport_orders', 'passport_orders.passport_id', '=', 'passports.id')->first();

        // dd($pass);

        // echo"<pre>";print_r($pass->toArray());die;

        if($pass){
           // $pass->image=asset($pass->FileId->file); 
            $data['passport'] = $pass;
            $view = view('front/topup/get_passport_view_customer',$data);
            return response()->json(['success'=>1,'view'=>$view->render()]);
        }else{
            return response()->json(['success'=>0,'message'=>'Passport not available on selected location.']);
        }
        
    }

    public function getTopupConfirmView(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all());// die;
        $p = PassportOrder::select('passport_orders.*','passports.price as pass_price')->where(['passport_orders.id'=>$request->id,'passport_orders.user_id'=>auth()->user()->id])->leftjoin('passports', 'passports.id', '=', 'passport_orders.passport_id');
        $pass = $p->first();
        $data['payment_id'] = 'pay_'.str_shuffle("FRENCHBREWW").rand(10,999);
        $data['passportConfirmOrder'] = $pass;
        $view = view('front/topup/passport_confirm_view',$data);
        return response()->json(['success'=>1,'view'=>$view->render()]);
    }

    public function getTopupSummaryView(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all());// die;
        $p = PassportOrder::where(['id'=>$request->id,'user_id'=>auth()->user()->id]);
        $data['passportOrder'] = $pass = $p->first();
        $view = view('front/topup/passport_summary_view',$data);
        return response()->json(['success'=>1,'view'=>$view->render()]);
    }
    
    public function topupOrderSubmit(Request $request){
        // echo '<pre>request - '; print_r($request->all()); die;
       

        $passport_id = $request->id;
        $passportOrder = PassportOrder::where(['id'=>$passport_id,'user_id'=>auth()->user()->id])->first();
        if(!$passportOrder){
            return response()->json(['success' => 0,'message' => 'Invalid Passport.']);
        }else{

            $passportOrder = PassportOrder::where(['id'=>$passport_id,'user_id'=>auth()->user()->id])->first();
            
           //echo"b";die;
                

                return response()->json([
                    'success' => 1,
                    'message' => 'Order Created',
                    'order_id'=>$passportOrder->id,
                    'price'=>$passportOrder->price,
                    'payment_id'=>'pay_'.str_shuffle("FRENCHBREWW").rand(10,999),
                ]);

         
            
        }
    }

    public function topupConfirmSubmit(Request $request)
    {
        //   echo '<pre>request - '; print_r($request->all()); die;
        $validator =Validator::make($request->all(), [
            'id' => 'required',
            'payment_id'=>'required',
        ]);
        if ($validator->fails()) {
            return $validator->validate();
        }

        $order_id = $request->id;
        $payment_id = $request->payment_id;
        $payment_date = date('Y-m-d');
   
         $UserOrder = PassportOrder::where('id',$order_id)->where('user_id',auth()->user()->id)->where('status',1)->first();

       
                $passport = Passport::where('id', $UserOrder->passport_id)->first();
                $volume = $remaining_amount = $passport->volume;
                $start_date = date('Y-m-d');
                $end_date = date('Y-m-d', strtotime('+1 year'));
              //  $passport_code = generatePassportCode();



                $pass_arr['passport_code']=$UserOrder->passport_code;
                $pass_arr['phone']=$UserOrder->User->phone;
                $pass_arr['email']=$UserOrder->User->email;
                $pass_arr['price']=$UserOrder->price;
                $pass_arr['volume']=$UserOrder->volume_amount;
                $pass_arr['validity']=$start_date.' - '.$end_date;
            
                return response()->json([
                    'success' => 1,
                    'message' => 'Payment Success',
                    'id' => $order_id,
                ]);
        
    }

    public function payment_submit(Request $request){
        // echo '<pre>request - '; print_r($request->all()); 
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));        
        $payment = $api->payment->fetch($request->pay_id);
        
        $cheakOrder = PassportOrder::where(['id'=>$request->id,'status'=>1,'user_id'=>auth()->user()->id])->first();

        $pay_data = array(
            'payment_id' => $request->pay_id,
            'payment_date' => date('Y-m-d'),
            'status' => 1,
            'pay_status' => $request->status,
            'pay_res' => json_encode($payment->toArray())
        );

      
	  $passdata = Passport::where(['id'=>$cheakOrder->passport_id])->first();
	  $bonus_amount = GeneralSetting::where('meta_key','top_up_benifit')->first();
      $amaunt_cal = PassportOrderHistory::where('passport_order_id',$request->id)->orderBy('created_at', 'DESC')->first();
	  $order_count = PassportOrderHistory::where('passport_order_id',$request->id)->count();
	 // $order_count--;
	  if($order_count > 1){
		  $meta_value = $bonus_amount->meta_value * $order_count;
	  }else{
		  $meta_value = $bonus_amount->meta_value;
	  }
	  	
      $total_amont_bonus = $passdata->volume + $meta_value; 
	  
	  
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
            'price'=>$passdata->price,
            'passport_id'=>$cheakOrder->passport_id,
            'status'=>$cheakOrder->status,
            'volume_amount'=>$total_amont_bonus,
            'used_amount' => $cheakOrder->used_amount,
            'remaining_amount' =>$total_amont_bonus,
            'payment_id' => $request->pay_id,
            'payment_date' => $cheakOrder->payment_date,
            'pay_status' => $cheakOrder->pay_status,
            'pay_res' => json_encode($payment->toArray()),
            'order_date' => $cheakOrder->order_date,
            'start_date' =>  $start_date,
            'end_date' => $end_date,
            'is_custom' => $cheakOrder->is_custom
           
        );
        PassportOrderHistory::insert($pay_data_hstry);
        

        if($request->status == 1){
            Cart::destroy();
            return response()->json(['status' => 1,'msg' => 'Payment Success','id' => $request->id]);
        }elseif($request->status == 2){
            return response()->json(['status' => 2,'msg' => 'Payment Failed','id' => $request->id]);
        }
    }

    function getpassportlist(){

        $data['orders'] = PassportOrder::where('status',1)->where('user_id',auth()->user()->id)->get();
        $view = view('front/topup/get_user_passport_list',$data)->render();

        return response()->json(['status' => 1,'view' => $view]);
    }
}
