<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\UploadImage;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected $page;
    public function __construct(){
        $this->page = new \stdClass();
    }
   
   

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function general()
    {
        $this->page->title = 'General Setting';
        $setting_data = GeneralSetting::all();
        $settings=array();
        foreach($setting_data as $set){
            $settings[$set->meta_key]=$set->meta_value;
        }
        $site_image = UploadImage::where('id',$settings['site_logo'])->first();
        // echo '<pre>';print_r($site_image);die;
        return view('admin.Settings.general', ['settings' => $settings, 'page' => $this->page,'site_image' => $site_image]);
    }

    public function general_setting(Request $request)
    {
        $settings = $request->settings;
        foreach($settings as $k=>$val){
            GeneralSetting::where('meta_key', $k)
            ->update([
                'meta_value' => $val
                ]);
        }
        return response()->json(['success'=>1,'message'=>'General Setting updated successfully.']);
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
			 $admin = Admin::find(auth()->guard('admin')->user()->id);
			if (Hash::check($request->old_password, $admin->password)) { 
			   
				$admin->password = Hash::make($request->new_password);
				$admin->save();
				return response()->json(['success'=>1,'message'=>'Password updated successfully.']);
			} else {
				return response()->json(['success'=>0,'message'=>'Old Password does not match.']);
			}
		}
    }
	public function upload_site_logo(Request $request)
    {
		$ext_arr= array('jpg','png','jpeg'); 
		if(!empty($request->file('file'))){ 
		  //Move Uploaded File
		  $file = $request->file('file');
		  $ext = $file->getClientOriginalExtension();
		  if(in_array($ext,$ext_arr)){
		  $destinationPath = public_path().'/front-assets/images/site_logo/';
		  $file_name = rand(10,999)."_".$file->getClientOriginalName();
         
		  $file->move($destinationPath,$file_name);
		  $file_data = UploadImage::create([
				'file'          => $file_name, 
				]);
			return response()->json(['status'=>1,'file_id'=>$file_data->id,'file_path'=>asset('front-assets/images/site_logo/'.$file_data->file)]);
		  }else{
			  return response()->json(['status'=>0,'msg'=>'File type not allowed']);
		  }
		}
		
    }
}
