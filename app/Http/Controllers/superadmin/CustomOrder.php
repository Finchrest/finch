<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Passport;
use App\Models\PassportOrder;
use App\Models\PassportUsedOrder;
use App\Models\Item;
use Validator;
use Illuminate\Support\Facades\Hash;

class CustomOrder extends Controller
{
    protected $page;
    protected $module;
    protected $modal;
    protected $route;


    public function __construct()
    {
        $this->page = new \stdClass;
        $this->modal = 'App\Models\Order';
        $this->route = new \stdClass;
        $this->module = 'customorder';
        $this->route->list = route('superadmin.customorders.list');
        $this->route->add = route('customorderData.create');
        $this->route->store = route('customorderData.store');
        $this->route->show = route("customorderData.show", ":id");
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


        $totalRecords = PassportUsedOrder::all()->where('order_type', 2)->count();

        $totalRecordwithFilter = $totalRecords;

        $qry = PassportUsedOrder::offset($row)->take($rowperpage);

        $qry->where('passport_used_orders.order_type', 2);
        $qry->select('passport_used_orders.*', 'users.name as userName');
        $qry->leftJoin('users', 'users.id', '=', 'passport_used_orders.user_id');

        if ($searchValue) {
            $qry->where(function ($query) use ($searchValue) {
                $query->where('passport_used_orders.passport_code', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('passport_used_orders.amount', 'like', '%' . $searchValue . '%');
            });
        }


        $result = $qry->get();

        // echo"<pre>";print_r($result->toArray());die;  

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

            $data[] = array(
                "sno" => $i,
                "passport_code" => '#' . $row->passport_code,
                "user" => $row->userName,
                "price" => '₹' . $row->amount,
                "order_date" => date('d M, Y', strtotime($row->order_date)),
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


    public function create()
    {

        $users = User::where('is_old', 1)->get();
        $passports = Passport::get();
        $passportsorder = PassportOrder::get();

        return view(
            'superadmin.' . $this->module . '.add',
            [
                'route' => $this->route,
                'module' => $this->module,
                'users' => $users,
                'passports' => $passports,

            ]
        );
    }


    public function store(Request $request)
    {
        // echo"<pre>CO request - ";print_r($request->all());die;
        $id = $request->id;
        if ($id) {
            return $this->update_data($request);
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'user_id'       => 'required',
                    'name' => 'required',
                    'phone' => 'required',
                    'address'   => 'required',
                    'city'   => 'required',
                    'passport_code'   => 'required',
                    'volume'   => 'required',
                    'remaining'   => 'required',
                    'used'   => 'required',
                    'date'   => 'required',
                    // 'remarks'   => 'required'
                ]
            );

            if ($validator->fails()) {
                return $validator->validate();
            } else {

                $obj = PassportOrder::firstOrNew(['passport_code' => $request->passport_code, 'user_id' => $request->user_id]);
                $usedAmount = $request->volume - $request->remaining;
                $obj->volume_amount = $request->volume;
                $obj->used_amount = $usedAmount;
                $obj->remaining_amount = $request->remaining;
                $obj->is_custom = 1;
                $obj->save();

                $obj = PassportUsedOrder::firstOrNew(['id' => $id]);
                $obj->passport_code = $request->passport_code;
                $obj->user_id = $request->user_id;
                $obj->amount = $request->used;
                $obj->order_date = $request->date;
                $obj->order_type = 2;
                $obj->order_id = 0;
                $obj->save();
                return response()->json(['success' => 1, 'message' => $this->module . ' created successfully.']);
            }
        }
    }



    public function show($id)
    {
        $info = $this->modal::find($id);
        $items = array();
        $p = Item::select('items.id', 'items.product_id', 'items.price', 'items.sub_total', 'items.qty');
        $p->where('items.order_id', $id);
        $items = $p->get()->toArray();
        $i = 0;
        foreach ($items as $item) {
            $items[$i] = $item;
            $items[$i]['product'] = getProductDetail($item['product_id']);
            $i++;
        }

        // echo '<pre>';print_r($items);die;        
        return view('superadmin.' . $this->module . '.show', [
            'info' => $info,
            'items' => $items,
            'route' => $this->route,
            'module' => $this->module
        ]);
    }

    public function getPassportVolume(Request $request)
    {
        //echo '<pre>'; print_r($request->all()); die;
        $passport = PassportOrder::where('passport_code', $request->passport_id)->first();
        //echo '<pre>passport - '; print_r($passport); die;

        return response()->json(['success' => 1, 'vol' => $passport->volume_amount, 'used' => $passport->used_amount, 'remaining' => $passport->remaining_amount, 'order_date' => $passport->order_date, 'name' => $passport->name]);
    }


    // public function getUserdetail(Request $request)
    // {   
    //     // echo '<pre>'; print_r($request->all()); die;
    //     $users = User::first();
    //     //echo '<pre>passport - '; print_r($users); die;

    //   return response()->json(['success'=>1,'name'=>$users->name,'phone'=>$users->phone]);
    // }


    public function getUserdetail(Request $request)
    {

        $passportorder = PassportOrder::where('user_id', $request->id)->get();

        // echo '<pre>location - '; print_r($passportorder->toArray()); die;
        if (isset($request->type) && $request->type == 'edit') {
            $output = '<option value="" >Select</option>';
            if (!empty($passportorder->toArray())) {
                foreach ($passportorder as $passportorders) {
                    if ($request->id == $passportorders->user_id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $output .= '<option value="' . $passportorders->user_id . '" ' . $selected . '>' . ucwords($passportorders->passport_code) . '</option>';
                }
            } else {
                $output .= '<option value="">No place found on selected location.</option>';
            }
            return response()->json(['status' => 1, 'opt' => $output]);
        } else {
            $output = '<option value="" >Select</option>';
            $phone = "";
            if (!empty($passportorder->toArray())) {
                foreach ($passportorder as $passportorders) {
                    //echo '<pre>location - '; print_r($passportorders->toArray()); die;
                    $output .= '<option value="' . $passportorders->passport_code . '">' . ucwords($passportorders->passport_code) . '</option>';
                    $phone = $passportorders->phone;
                }
            } else {
                $output .= '<option value="">No place found on selected location.</option>';
            }
            return response()->json(['status' => 1, 'opt' => $output, 'phone' => $phone]);
        }
    }
}
