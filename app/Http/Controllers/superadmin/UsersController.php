<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\PassportOrder;
use App\Models\PassportUsedOrder;
use App\Models\Item;
use App\Models\Coupon_redeemed;
use App\Models\UserEnquiry;
use Validator;
use Illuminate\Support\Facades\Hash;
use DB;

class UsersController extends Controller
{
    protected $page;
    protected $module;
    protected $modal;
    protected $route;


    public function __construct()
    {

        $this->page = new \stdClass;
        $this->modal = 'App\Models\User';
        $this->route = new \stdClass;
        $this->module = 'User';
        $this->route->add = route('usersdata.create');
        $this->route->store = route('usersdata.store');
        $this->route->edit = route("usersdata.edit", ":id");
        $this->route->destroy = route("usersdata.destroy", ":id");
        // $this->route->view = route("admin.profile.view",":id");
    }

    public function index()
    {
        //echo $this->route->add;die;
        $this->page->title = $this->module . 's List';
        return view('superadmin.' . $this->module . '.index', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module]);
    }

    public function user_enquiry_list()
    {

        //echo $this->route->add;die;
        $this->page->title = 'User Enquiry List';
        return view('superadmin.' . $this->module . '.user_enquiry', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module]);
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

        $qry = $this->modal::offset($row)->take($rowperpage);


        if ($searchValue) {
            $qry->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%')
                    ->orWhere('phone', 'like', '%' . $searchValue . '%');
            });
        }

        $result = $qry->get();

        $data = array();
        $i = 1;
        foreach ($result as $row) {
            if ($row->status == '1') {
                $status = 'Active';
            } else {
                $status = 'Inactive';
            }

            if ($row->is_old == '0') {
                $isNew = 'New';
            } else {
                $isNew = 'Old';
            }

            $action = '';
            $edit_url = $this->route->edit;
            $view = route("superadmin.profile.view", $row->id);
            $destroy_url = $this->route->destroy;
            $action .= '<a href="#!" class="" onclick=edit_row("' . $edit_url . '",' . $row->id . ');><i class="fa fa-edit"></i> Edit</a><br>';
            $action .= '<a href="#!" class="text-danger" onclick=delete_row("' . $destroy_url . '",' . $row->id . ')><i class="text-danger fa fa-trash"></i> Delete</a><br>';
            $action .= '<a href="' . $view . '" class="text-primary"><i class="fa fa-eye" aria-hidden="true"> View</i>
            </a><br>';

            $data[] = array(
                "sno" => $i,
                "name" => $row->name . '<br>' . $row->email . '<br>' . $row->phone,
                "login_pin" => $row->login_pin,
                "login_otp" => $row->otp,
                "status" => $status,
                "user_type" => $isNew,
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

    public function user_enquiry_ajax_list(Request $request)
    {

        ## Read value
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value


        $totalRecords = UserEnquiry::all()->count();

        $totalRecordwithFilter = $totalRecords;

        $qry = UserEnquiry::offset($row)->take($rowperpage);


        if ($searchValue) {
            $qry->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%')
                    ->orWhere('phone', 'like', '%' . $searchValue . '%')
                    ->orWhere('message', 'like', '%' . $searchValue . '%')
                    ->orWhere('phone', 'like', '%' . $searchValue . '%');
            });
        }
        $qry->orderBy('id', 'DESC');



        $result = $qry->get();

        $data = array();
        $i = 1;
        foreach ($result as $row) {
            if ($row->status == '1') {
                $status = 'Active';
            } else {
                $status = 'Inactive';
            }

            if ($row->is_old == '0') {
                $isNew = 'New';
            } else {
                $isNew = 'Old';
            }

            $action = '';
            $edit_url = $this->route->edit;
            $destroy_url = $this->route->destroy;
            $action .= '<a href="#!" onclick=edit_row("' . $edit_url . '",' . $row->id . ');><i class="fa fa-edit"></i></a>';
            $action .= '&nbsp;&nbsp;<a href="#!" class="text-danger" onclick=delete_row("' . $destroy_url . '",' . $row->id . ')><i class="text-danger fa fa-trash"></i></a>';

            $user_detail = '<small>';
            $user_detail .= $row->name . '<br>';
            $user_detail .= $row->phone . '<br>';
            $user_detail .= $row->email . '<br>';
            $user_detail .= '</small>';

            $message = str_word_count($row->message);
            $string = '';
            if ($message > 10) {

                $stringCut = $this->limit_text($row->message, 10);

                $string .=  $stringCut;
                $string .= '... <a href="javascript:void(0);" onclick="viewMore(`' . $row->id . '`)">Read More</a>';
            } else {
                $string = $row->message;
            }

            $data[] = array(
                "sno" => $i,
                "name" => $user_detail,
                "message" => $string,
                "created_at" => date('Y-m-d h:i A', strtotime($row->created_at)),
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

    public function limit_text($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    public function create()
    {
        return view('superadmin.' . $this->module . '.add', ['route' => $this->route, 'module' => $this->module]);
    }


    public function store(Request $request)
    {
        $id = $request->id;
        if ($id) {
            return $this->update_data($request);
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'name'       => 'required',
                    'email'          => 'required|email|unique:users',
                    'phone'          => 'required|digits:10|unique:users',
                    'password'            => 'required',
                    'is_new'            => 'required',
                    'status'            => 'required',
                    'login_pin'            => 'required',
                ]
            );

            if ($validator->fails()) {
                return $validator->validate();
            } else {
                $obj = $this->modal::firstOrNew(['id' => $id]);
                $obj->name = $request->name;
                $obj->email = $request->email;
                $obj->phone = $request->phone;
                $obj->password = Hash::make($request->password);
                $obj->is_old = $request->is_new;
                $obj->status = $request->status;
                $obj->login_pin = $request->login_pin;
                $obj->save();
                return response()->json(['success' => 1, 'message' => $this->module . ' created successfully.']);
            }
        }
    }


    public function edit($id)
    {
        $info = $this->modal::find($id);
        return view('superadmin.' . $this->module . '.edit', [
            'info' => $info,
            'route' => $this->route,
            'module' => $this->module
        ]);
    }

    public function update_data(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name'       => 'required',
                'email'          => 'required|email|unique:users,email,' . $request->id,
                'phone'          => 'required|unique:users,phone,' . $request->id,
                'is_new'            => 'required',
                'status'            => 'required',
                'login_pin'            => 'required',
            ]
        );

        if ($validator->fails()) {
            return $validator->validate();
        } else {
            $obj = $this->modal::firstOrNew(['id' => $request->id]);
            $obj->name = $request->name;
            $obj->email = $request->email;
            $obj->phone = $request->phone;
            if ($request->password) {
                $obj->password = Hash::make($request->password);
            }
            $obj->status = $request->status;
            $obj->is_old = $request->is_new;
            $obj->login_pin = $request->login_pin;
            $obj->save();

            return response()->json(['success' => 1, 'message' => $this->module . ' updated successfully.']);
        }
    }


    public function destroy($id)
    {
        $user = $this->modal::find($id);
        $user->delete();
        return response()->json(['success' => 1, 'message' => $this->module . ' delete successfully.']);
    }


    public function viewmore(Request $request)
    {
        $user = UserEnquiry::where('id', $request->id)->first();
        return view('superadmin.' . $this->module . '.message', ['route' => $this->route, 'module' => $this->module, 'user' => $user]);
    }

    public function profileView($id)
    {
        // echo$id;die;
        $this->page->title = $this->module . 's View';
        $user = User::where('id', $id)->first();
        $orders = Order::where('status', 1)->where('user_id', $id)->orderBy('id', 'DESC')->get();
        $PassportOrder = PassportOrder::where('user_id', $id)->get();
        return view('superadmin.' . $this->module . '.view', ['route' => $this->route, 'page' => $this->page, 'module' => $this->module, 'user' => $user, 'orders' => $orders, 'PassportOrder' => $PassportOrder]);
    }


    public function get_all_coupons(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all()); die;

        // echo '<pre>orders_items - '; print_r($data['orders']); die;

        $passportReedemed = PassportOrder::where(['id' => $request->id, 'user_id' => $request->uid])->first();
        $data['coupon_arr'] = '';
        if ($passportReedemed) {
            $data['coupon_arr'] = explode(',', $passportReedemed->coupon_redeem_ids);
        }
        $data['allcoupans'] = Coupon_redeemed::get();
        $data['id'] =  $request->id;
        $data['uid'] =  $request->uid;
        $view = view('superadmin/User/coupon_reddemed_view', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }

    public function coupon_store(Request $request)
    {
        // echo"<pre>";print_r($request->all());die;
        $validator = Validator::make(
            $request->all(),
            [
                'coupon_redem'       => 'required',
            ]
        );

        if ($validator->fails()) {
            return $validator->validate();
        } else {
            $coupons = implode(',', $request->coupon_redem);
            // echo"<pre>";print_r($coupons);die;
            PassportOrder::where(['id' => $request->id, 'user_id' => $request->uid])->update(['coupon_redeem_ids' => $coupons]);

            return response()->json(['success' => 1, 'message' => 'Coupon updated successfully.']);
        }
    }

    public function get_user_order_details(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all()); die;
        $id = $request->id;
        $data = array();
        $order = Order::where('id', $id)->first()->toArray();
        if (!$order) {

            return response()->json(['success' => 0, 'message' => 'Invalid Order']);
        } else {
            $data['order'] = $order;

            $p = Item::where('items.order_id', $id);
            $items = $p->get()->toArray();
            // echo '<pre>items - '; print_r($items); die;
            $i = 0;
            foreach ($items as $item) {
                $data['order']['items'][$i] = $item;
                $data['order']['items'][$i]['product'] = $this->getProductDetail($item['product_id']);
                $i++;
            }

            // echo '<pre>orders_items - '; print_r($data['order']['items']); die;
            $view = view('superadmin/User/order_products_view', $data);
            return response()->json(['success' => 1, 'view' => $view->render()]);
        }
    }

    public function get_user_passport_details(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all()); die;
        $id = $request->id;
        $product_arr = array();
        $passportOrder = PassportOrder::select('passport_code')->where('id', $id)->first();
        if (!$passportOrder) {

            return response()->json([
                'success' => false,
                'message' => 'Invalid Order.',
            ], 400);
        } else {

            $order_data = array();
            $passport_code = $passportOrder['passport_code'];
            $items = PassportUsedOrder::select('order_type', 'order_date', 'amount', 'created_at')->where('passport_code', $passport_code)->get();

            // echo '<pre>items - '; print_r($items->toArray()); die;
            $i = 0;
            foreach ($items as $item) {
                $order_data[$i]['order_date'] = date('d M, Y', strtotime($item->created_at));
                $order_data[$i]['amount'] = $item->amount;
                $order_type = 'Direct';
                if ($item->order_type == 1) {
                    $order_type = 'Online order';
                }
                if ($item->order_type == 2) {
                    $order_type = 'Custom order';
                }
                $order_data[$i]['order_type'] = $order_type;

                $i++;
            }

            $data['orders'] = $order_data;
            $data['passport_code'] = $passport_code;
            // echo '<pre>orders_items - '; print_r($data['orders']); die;
            $view = view('superadmin/User/passport_details_view', $data);
            return response()->json(['success' => 1, 'view' => $view->render()]);
        }
    }

    public function getProductDetail($id)
    {
        $product_arr = array();
        $product = Product::find($id);

        $product_arr = $product;
        $product_arr['image'] = asset($product->FileId->file);
        $product_arr['type_name'] = $product->Type->name;
        $product_arr['category_name'] = $product->Category->name;
        $product_arr['place_name'] = $product->Place->name;
        $product_arr['location_name'] = $product->Place->Location->name;

        if ($product->type == 1) {
            $product_arr['malts'] = get_malt_explode($product->malt);
            $product_arr['hops'] = get_hop_explode($product->hops);
        } else {
            unset($product_arr['hops']);
            unset($product_arr['malt']);
            unset($product_arr['quantity']);
            unset($product_arr['percentage']);
            unset($product_arr['color']);
            unset($product_arr['orignal_gravity']);
            unset($product_arr['style']);
        }

        unset($product_arr['created_at']);
        unset($product_arr['updated_at']);
        unset($product_arr['status']);
        return $product_arr->toArray();
    }
}
