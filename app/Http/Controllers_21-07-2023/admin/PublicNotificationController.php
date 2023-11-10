<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User,SubPublicNotification,PublicNotification};
use Validator;
use Illuminate\Support\Facades\Hash;

class PublicNotificationController extends Controller
{
    protected $page;
    protected $module;
    protected $modal;
    protected $route;


    public function __construct()
    {

        $this->page = new \stdClass;
        $this->modal = new PublicNotification;
        $this->route = new \stdClass;
        $this->module = 'public-notification';
        $this->route->store = route('public-notification.store');

    }

    public function index()
    {
        $users = User::all();
        //echo $this->route->add;die;
        $this->page->title = $this->module ;
        return view('admin.' . $this->module . '.index', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module,'users'=>$users]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make(
                $request->all(),
                [
                    'title'       => 'required',
                    'user_type'       => 'required',
                    'msg'          => 'required|string|max:64',
                ]
            );

            if ($validator->fails()) {
                return $validator->validate();
            } else {

                $obj = new $this->modal;
                $obj->title = $request->title;
                $obj->msg = $request->msg;
                $obj->save();

                if($obj->id){

                    if($request->user_type == 1){
                        $ids =   $request->user_ids;
                    }else{
                        $ids = User::pluck('id');
                    }

                  foreach($ids as $id){

                    $sub = new SubPublicNotification;
                    $sub->public_notifictions_id = $obj->id;
                    $sub->user_id = $id;
                    $sub->save();

                  }
                    
                }
                return response()->json(['success' => 1, 'message' => 'Public Notification Send Successfully.']);
            }
    }

}
