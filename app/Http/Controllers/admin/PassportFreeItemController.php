<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PassportFreeItem;
use App\Models\Product;
use App\Models\Passport;
use App\Models\Malt;
use Validator;
use Illuminate\Support\Facades\Hash;

class PassportFreeItemController extends Controller
{
    protected $page;
    protected $module;
    protected $modal;
    protected $route;


    public function __construct()
    {
        $this->page = new \stdClass;
        $this->modal = 'App\Models\PassportFreeItem';
        $this->route = new \stdClass;
        $this->module = 'PassportFreeItem';
        $this->route->list = route('admin.passportFreeItems.list');
        $this->route->add = route('passportFreeItems.create');
        $this->route->store = route('passportFreeItems.store');
        $this->route->edit = route("passportFreeItems.edit", ":id");
        $this->route->destroy = route("passportFreeItems.destroy", ":id");
    }

    public function show($passport_id)
    {  // echo"a";die;
        //echo $this->route->add;die;
        $passportData = Passport::where('id', $passport_id)->first();
        $this->page->title = $this->module . 's List';
        return view('admin.' . $this->module . '.index', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module, 'passport_id' => $passport_id, 'passportData' => $passportData]);
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

        $qry = $this->modal::where('passport_free_item.passport_id', $request->passport_id)->offset($row)->take($rowperpage);
        $qry->select('passports.name as passName', 'passport_free_item.*', 'products.title as ProductName');
        $qry->join('passports', 'passports.id', '=', 'passport_free_item.passport_id');
        $qry->join('products', 'products.id', '=', 'passport_free_item.product_id');

        if ($searchValue) {
            $qry->where(function ($query) use ($searchValue) {
                $query->where('passports.name', 'like', '%' . $searchValue . '%');
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

            $action = '';
            $edit_url = $this->route->edit;
            $destroy_url = $this->route->destroy;
            $action .= '<a href="#!" onclick=edit_row("' . $edit_url . '",' . $row->id . ');><i class="fa fa-edit"></i></a>';
            $action .= '&nbsp;&nbsp;<a href="#!" class="text-danger" onclick=delete_row("' . $destroy_url . '",' . $row->id . ')><i class="text-danger fa fa-trash"></i></a>';

            $data[] = array(
                "sno" => $i,
                "passport_id" => $row->passName,
                "product_id" => $row->ProductName,
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

    public function create(Request $request)
    {

        $products = Product::where('for_passport', 1)->where('status', 1)->get();
        return view('admin.' . $this->module . '.add', ['route' => $this->route, 'module' => $this->module, 'passport_id' => $request->passport_id, 'products' => $products]);
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
                    'products' => 'required',
                ]
            );

            if ($validator->fails()) {
                return $validator->validate();
            } else {
                for ($i = 0; $i < count($request->products); $i++) {
                    $obj = $this->modal::firstOrNew(['id' => $id]);
                    $obj->passport_id = $request->passport_id;
                    $obj->product_id = $request->products[$i];
                    $obj->status = $request->status;
                    $obj->save();
                }

                return response()->json(['success' => 1, 'message' => $this->module . ' created successfully.']);
            }
        }
    }


    public function edit($id)
    {
        $products = Product::where('for_passport', 1)->get();
        $info = $this->modal::find($id);
        return view('admin.' . $this->module . '.edit', [
            'info' => $info,
            'products' => $products,
            'route' => $this->route,
            'module' => $this->module
        ]);
    }

    public function update_data(Request $request)
    {
        // echo"<pre>";print_r($request->all());die;
        $validator = Validator::make(
            $request->all(),
            [
                'products' => 'required',
            ]
        );

        if ($validator->fails()) {
            return $validator->validate();
        } else {
            $obj = $this->modal::firstOrNew(['id' => $request->id]);
            $obj->product_id = $request->products;
            $obj->passport_id = $request->passport_id;
            $obj->status = $request->status;
            $obj->save();


            $obj = Product::firstOrNew(['id' => $request->products]);
            $obj->status = $request->status;
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
}
