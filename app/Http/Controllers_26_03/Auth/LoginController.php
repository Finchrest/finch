<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Cart;
use App\Models\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	public function showLoginPage(){ 
        $data = array();
        // echo '<pre>data - '; print_r($data['product']->toArray()); die;
        $view = view('auth/login_detail',$data);
        return response()->json(['success'=>1,'view'=>$view->render()]);
	}

    public function submitLoginDetails(Request $request){
        // echo '<pre>request - '; print_r($request->all()); die;

        $validator = Validator::make($request->all(), [
            'email' => 'required|min:10',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['success' =>0,'error' => $validator->messages()], 200);
        }else{
            $user = User::where('phone',$request->email)->orWhere('email',$request->email)->first();
            $otp=rand(1111,9999);
            if(!$user){
                if (is_numeric($request->email)){
                    $user = User::create([
                        'phone' => $request->email,
                        'email' => $request->email,
                        'otp'=>$otp,
                        'is_new'=>1
                    ]);
                }else{
                    return response()->json(['success'=>0, 'message'=>'You need register with phone number']);
                }
                
                User::where('id',$user->id)->update(array('otp'=>$otp));

                $message = $otp.' is your OTP to login to Finch at eWards';
                $this->sendMessage($request->email, $message);

                return response()->json(['success' =>2,'message' =>'Otp send successfully','email'=>$request->email,'otp' => $otp]);
            }else{
                // echo "<pre>.$otp"; print_r($user); die;
                User::where('id',$user['id'])->update(array('otp'=>$otp));

                $message = $otp.' is your OTP to login to Finch at eWards';
                $send_message = $this->sendMessage($user->phone, $message);
                $request->session()->put('age',$user->age);
                return response()->json(['success' =>2,'message' =>'Otp send successfully ','email'=>$request->email,'otp' => $otp]);

            }
        }
    }

    public function viewOtpPage(Request $request){
        // echo '<pre>'; print_r($request->all()); die;
        $data['email'] = $request->email;
        $data['otp'] = $request->otp;
        // echo '<pre>data - '; print_r($data['product']->toArray()); die;
        $view = view('auth/otpVerify',$data);
        return response()->json(['success'=>1,'view'=>$view->render()]);
    }

    public function otpSubmit(Request $request){ 
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'otp' => 'required',
        ]);
        if ($validator->fails()) {
            // return response()->json(['error' => $validator->messages()], 200);
            return $validator->validate();
        }else{
            $user = User::select('id','name','email','phone','is_new')->where('otp',$request->otp)->first();
            if($user){
               
                    Auth::login($user);
                    return response()->json(['success' =>1,'message'=>'Otp Verify successfully','id'=>$user->id,'email'=>$request->email]);
                
            }else{
                return response()->json(['success' => 0,'message' => 'Invalid Otp.']);
            }
        }
    }


    public function resendOtp(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>0,'error' => $validator->messages()], 200);
        }else{
            $user = User::where('phone',$request->email)->orWhere('email',$request->email)->first();
            if(!$user){
                return response()->json(['success' => 0,'message' => 'Invalid User.']);
            }else{
                $otp=rand(1111,9999);
                User::where('phone',$request->email)->orWhere('email',$request->email)->update(array('otp'=>$otp));
                
                $message = $otp.' is your OTP to login to Finch at eWards';
                $this->sendMessage($user->phone, $message);
                return response()->json(['success'=>1,'message'=>'Otp resended successfully','otp'=>$otp]);
            }
        }
    }

    
    public function sendMessage($mobile, $message){
        // echo $mobile.' - '.$message; //die;
        if(!empty($mobile) && !empty($message)){
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

            // $url = "http://www.mshastra.com/sendurl.aspx?user=20101182&pwd=sms@2021&senderid=FINCHH&mobileno=917748018188&msgtext=1111 is your OTP to login to Finch at eWards&CountryCode=All";
            $ch = curl_init();
        
            $url = "http://www.mshastra.com/sendurl.aspx";
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
            // echo $getUrl;//die;
        
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_URL, $getUrl);
            curl_setopt($ch, CURLOPT_TIMEOUT, 80);
            
            $response = curl_exec($ch);
            //echo '<pre>';print_r($response);die;  
            if(curl_error($ch)){
                // echo 'Request Error:' . curl_error($ch);
                return false;
            }else{
                // echo '<pre>';print_r($response);die;  
                // echo 'true - '.$response;
                return true;
            }     
            curl_close($ch);
        }
    }

	public function logout(){
		Cart::destroy();
		Auth::logout();
        
		
        // session()->put('location','');
        // session()->put('location_name','');
        session()->put('age','');
		return redirect('/');
	}
}
