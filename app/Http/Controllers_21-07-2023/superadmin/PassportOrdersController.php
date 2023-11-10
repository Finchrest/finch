<?php

namespace App\Http\Controllers\superadmin;

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
        $this->route->list = route('superadmin.passport_orders.list');
        $this->route->add = route('passport_ordersData.create');
        $this->route->show = route("passport_ordersData.show", ":id");
    }

    public function index()
    {
        //echo $this->route->add;die;
        $this->page->title = $this->module . 's List';
        return view('superadmin.' . $this->module . '.index', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module]);
    }


    public function list(Request $request)
    {
        ## Read value
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value


        $totalRecords = $this->modal::all()->count();

        $totalRecordwithFilter = $totalRecords;

        $qry = $this->modal::select('passport_orders.*', 'users.name', 'users.phone')->offset($row)->leftJoin('users', 'users.id', '=', 'passport_orders.user_id')->take($rowperpage);

        if ($searchValue) {
            $qry->where(function ($query) use ($searchValue) {
                $query->where('passport_code', 'like', '%' . $searchValue . '%')
                    ->orWhere('price', 'like', '%' . $searchValue . '%')
                    ->orWhere('volume_amount', 'like', '%' . $searchValue . '%')
                    ->orWhere('remaining_amount', 'like', '%' . $searchValue . '%')
                    ->orWhere('id', 'like', '%' . $searchValue . '%');
            });
        }

        $result = $qry->get();

        $data = array();
        $i = 1;
        foreach ($result as $row) {
            if ($row->status == '1') {
                $status = 'Complete';
            } else {
                $status = 'Not Complete';
            }

            $action = '';
            $show_url = $this->route->show;
            $action .= '<a href="#!" onclick=show_row("' . $show_url . '",' . $row->id . ');><i class="fa fa-eye"></i></a>';
            $name = $phone = '';
            if ($row->name) {
                $name = $row->name;
            }
            if ($row->phone) {
                $phone = $row->phone;
            }
            $data[] = array(
                "sno" => $i,
                "order_id" => '#' . $row->id,
                "passport_code" => '#' . $row->passport_code,
                "user" => $name . '<br>' . $phone,
                "price" => '₹' . $row->price,
                "volume" => '₹' . $row->volume_amount,
                "remaining" => '₹' . $row->remaining_amount,
                "validity" => $row->start_date . ' - ' . $row->end_date,
                "order_date" => $row->order_date,
                "payment_date" => $row->payment_date,
                "status" => $status,
                "created_at" => date('Y-m-d h:i A', strtotime($row->created_at)),
                "action" => $action,
            );

            $i++;
        }


        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }

    public function show($id)
    {
        $info = $this->modal::find($id);
        $items = array();
        $order_data = array();
        $passportOrder = PassportOrder::select('id', 'passport_code', 'passport_id', 'name', 'phone', 'email', 'price', 'payment_id', 'order_date', 'payment_date', 'volume_amount', 'used_amount', 'remaining_amount')->where('id', $id)->first()->toArray();
        $order_data['order'] = $passportOrder;
        $passport_code = $passportOrder['passport_code'];

        $items = PassportUsedOrder::select('order_type', 'order_date', 'amount')->where('passport_code', $passport_code)->get();


        $i = 0;
        foreach ($items as $item) {
            $order_data['order']['items'][$i]['order_date'] = date('d/m/Y', strtotime($item->order_date));
            $order_data['order']['items'][$i]['amount'] = $item->amount;
            $order_type = 'Direct';
            if ($item->order_type == 1) {
                $order_type = 'Online order';
            }
            $order_data['order']['items'][$i]['order_type'] = $order_type;

            $i++;
        }



        return view('superadmin.' . $this->module . '.show', [
            'info' => $order_data,
            'route' => $this->route,
            'module' => $this->module
        ]);
    }


    public function search(Request $request)
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
                $view = view('superadmin.user.user_search_empty', []);
                return response()->json(['success' => 1, 'view' => $view->render()]);
            } else {
                $view = view('superadmin.user.user_search', ['info' => $info, 'route' => $this->route, 'module' => $this->module]);
                return response()->json(['success' => 1, 'view' => $view->render()]);
            }
        }
    }
}
