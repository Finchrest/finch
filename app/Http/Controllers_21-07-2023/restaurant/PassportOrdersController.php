<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PassportOrder;
use App\Models\Passport;
use App\Models\PassportUsedOrder;
use Validator;
use DB;
use Illuminate\Support\Facades\Hash;

class PassportOrdersController extends Controller
{
    protected $page;
    protected $module;
    protected $modal;
    protected $route;


    public function __construct()
    {

        $this->page = new \stdClass;
        $this->modal = 'App\Models\PassportOrder';
        $this->route = new \stdClass;
        $this->module = 'PassportOrder';
        $this->route->list = route('admin.passport_orders.list');
        $this->route->add = route('passport_orders.create');
        $this->route->show = route("passport_orders.show", ":id");
    }


    public function index(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'search_user'       => 'required',
            ]
        );
        if ($validator->fails()) {
            return $validator->validate();
        } else {

            $info = PassportOrder::where('passport_code', $request->search_user)->first();
            if (empty($info)) {
                $view = view('admin.user.user_search_empty', []);
                return response()->json(['success' => 1, 'view' => $view->render()]);
            } else {
                $view = view('admin.user.user_search', ['info' => $info, 'route' => $this->route, 'module' => $this->module]);
                return response()->json(['success' => 1, 'view' => $view->render()]);
            }
        }
    }
}
