<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;
use Validator;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
  protected $page; 
  public function __construct()
  {
    $this->page = new \stdClass;   
    $this->route = new \stdClass;

  }

  public function index()
  {
      $this->page->title = 'User Setting';     
      return view('restaurant.Settings.user_setting', ['page' => $this->page]);
  }
  public function update_password(Request $request)
    {
        $validator =Validator::make($request->all(),
		[
            'old_password'          => 'required',
            'new_password'          => 'required|min:6|max:10',
            'confirm_password'      => 'required|same:new_password',
        ]);
		if ($validator->fails()) {
            return $validator->validate();
        }else{
			 $user = Place::find(auth()->guard('restaurant')->user()->id);
			if (Hash::check($request->old_password, $user->password)) { 
			   
				$user->password = Hash::make($request->new_password);
				$user->save();
				return response()->json(['success'=>1,'message'=>'Password updated successfully.']);
			} else {
				return response()->json(['success'=>0,'message'=>'Old Password does not match.']);
			}
		}
    }


}
