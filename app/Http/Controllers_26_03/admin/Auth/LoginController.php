<?php

namespace App\Http\Controllers\admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
	
	public function __construct()
    { 
       // $this->middleware('guest')->except('logout');
       // $this->middleware('guest:admin')->except('logout');
    }
	
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
	
	public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if($request->remember == 'on'){
            $remember = true;
        }else{
            $remember = false;
        }
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
			$user = Admin::where('email',$request->email)->first();
			Auth::guard('admin')->login($user);
            $res =array('status'=>1);
            return json_encode($res);die;
		}else {
            $m = json_encode(array('password'=>'Email Or Password Is Incorrect'));
			$res =array('status'=>0,'msg'=>$m);
			return json_encode($res);die;
        }
    }


	public function logout()
	{
		Auth::guard('admin')->logout();
		return redirect()->route('admin.login');
	}
   
}
