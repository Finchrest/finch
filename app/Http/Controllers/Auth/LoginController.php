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
use App\Models\PassportOrder;
use App\Models\GeneralSetting;


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

    public function showLoginPage()
    {
        $data = array();
        // echo '<pre>data - '; print_r($data['product']->toArray()); die;
        $view = view('auth/login_detail', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }

    public function submitLoginDetails(Request $request)
    {
        // echo '<pre>request - ';
        // print_r($request->all());
        // die;
        $validator = Validator::make($request->all(), [
            'email' => 'required|min:10',
            'login_data' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'error' => $validator->messages()], 200);
        } else {
            $user = User::where('phone', $request->email)->orWhere('email', $request->email)->first();

            if ($user) {
                $request->session()->put('uid', $user->id);
            }
            $otp = rand(1111, 9999);
            if ($request->login_data == 0) {
                if (!$user) {
                    if (is_numeric($request->email)) {
                        $user = User::create([
                            'phone' => $request->email,
                            'otp' => $otp,
                            'is_new' => 1
                        ]);

                        if ($user) {
                            $request->session()->put('uid', $user->id);
                        }
                    } else {
                        return response()->json(['success' => 0, 'message' => 'You need register with phone number']);
                    }

                    User::where('id', $user->id)->update(array('otp' => $otp));

                    $message = $otp . ' is your OTP to login to Finch BrewCafe Account';
                    $this->sendMessage($request->email, $message);

                    return response()->json(['success' => 2, 'message' => 'Otp send successfully', 'email' => $request->email, 'otp' => $otp]);
                } else {
                    // echo "<pre>.$otp"; print_r($user); die;
                    User::where('id', $user['id'])->update(array('otp' => $otp));

                    $message = $otp . ' is your OTP to login to Finch BrewCafe Account';
                    $send_message = $this->sendMessage($user->phone, $message);
                    $request->session()->put('age', $user->age);
                    return response()->json(['success' => 2, 'message' => 'Otp send successfully ', 'email' => $request->email, 'otp' => $otp]);
                }
            } else {
                return response()->json(['success' => 3, 'email' => $request->email]);
            }
        }
    }

    public function viewOtpPage(Request $request)
    {
        // echo '<pre>'; print_r($request->all()); die;
        $data['email'] = $request->email;
        $data['otp'] = $request->otp;
        // echo '<pre>data - '; print_r($data['product']->toArray()); die;
        $view = view('auth/otpVerify', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }
    public function viewPinPage(Request $request)
    {
        // echo '<pre>'; print_r($request->all()); die;
        $data['email'] = $request->email;
        $view = view('auth/PinVerify', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }

    public function otpSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'otp' => 'required',
        ]);
        if ($validator->fails()) {
            // return response()->json(['error' => $validator->messages()], 200);
            return $validator->validate();
        } else {
            $user = User::select('id', 'name', 'email', 'phone', 'is_new')->where('otp', $request->otp)->first();
            if ($user) {

                Auth::login($user);
                @$minimumAmount = GeneralSetting::where('id', 9)->first();
                @$Passport_Minimum_Amount = $minimumAmount->meta_value;

                @$remainAmounts = PassportOrder::where('user_id', $user->id)->get();

                @$remain_amount = 0;
                if (!empty($remainAmounts->toArray())) {
                    foreach (@$remainAmounts as $remainAmount) {
                        @$remain_amount += @$remainAmount->remaining_amount;
                    }
                }
                $uid = session()->get('uid');
                $orderType = session()->get('orderType');
                User::where('id',$uid)->update([
                    'orderType'=>$orderType,
                    'passport_order'=>null,
                    ]);
       
                return response()->json(['success' => 1, 'message' => 'Otp Verify successfully', 'id' => $user->id, 'phone' => $request->email, 'Passport_Minimum_Amount' => @$Passport_Minimum_Amount, 'Passport_Remain_Amount' => @$remain_amount]);



            } else {
                return response()->json(['success' => 0, 'message' => 'Invalid Otp.']);
            }
        }
    }
    public function pinSubmit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'pin' => 'required',
        ]);
        if ($validator->fails()) {
            // return response()->json(['error' => $validator->messages()], 200);
            return $validator->validate();
        } else {

            $user = User::select('id', 'name', 'email', 'phone', 'is_new')->where('login_pin', $request->pin)->where(function ($query) use ($request) {
                $query->where('phone', $request->email)
                    ->orWhere('email', $request->email);
            })->first();


            if ($user) {

                Auth::login($user);
                @$minimumAmount = GeneralSetting::where('id', 9)->first();
                @$Passport_Minimum_Amount = $minimumAmount->meta_value;

                @$remainAmounts = PassportOrder::where('user_id', $user->id)->get();

                @$remain_amount = 0;
                if (!empty($remainAmounts->toArray())) {
                    foreach (@$remainAmounts as $remainAmount) {
                        @$remain_amount += @$remainAmount->remaining_amount;
                    }
                }
                $uid = session()->get('uid');
                $orderType = session()->get('orderType');
                User::where('id',$uid)->update([
                    'orderType'=>$orderType ,
                    'passport_order'=>null,
                    ]);
                return response()->json(['success' => 1, 'message' => 'Login Pin Verify successfully', 'id' => $user->id, 'phone' => $request->email, 'Passport_Minimum_Amount' => @$Passport_Minimum_Amount, 'Passport_Remain_Amount' => @$remain_amount]);
            } else {
                return response()->json(['success' => 0, 'message' => 'Invalid Login Pin']);
            }
        }
    }

    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => 0, 'error' => $validator->messages()], 200);
        } else {
            $user = User::where('phone', $request->email)->orWhere('email', $request->email)->first();
            if (!$user) {
                return response()->json(['success' => 0, 'message' => 'Invalid User.']);
            } else {
                $otp = rand(1111, 9999);
                User::where('phone', $request->email)->orWhere('email', $request->email)->update(array('otp' => $otp));

                $message = $otp . ' is your OTP to login to Finch BrewCafe Account';
                $this->sendMessage($user->phone, $message);
                return response()->json(['success' => 1, 'message' => 'Otp resended successfully', 'otp' => $otp]);
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

    public function logout()
    {
        session()->forget('uid');
        session()->forget('orderType');
        Cart::destroy();
        Auth::logout();
        Session::put('is_model_open', '');
        // Session::flush();
        // session()->put('location','');
        // session()->put('location_name','');
        // Session::destroy();
        session()->put('age', '');
        return redirect('/');
    }
}
