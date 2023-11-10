<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Location;
use App\Models\Place;

class CouponsController extends Controller
{
    protected $page;
    protected $module;
    protected $modal;
    protected $route;


    public function __construct()
    {
        $this->page = new \stdClass;
        $this->modal = 'App\Models\Coupon';
        $this->route = new \stdClass;
        $this->module = 'Coupon';
        $this->route->list = route('superadmin.coupons.list');
        $this->route->add = route('couponsData.create');
        $this->route->store = route('couponsData.store');
        $this->route->edit = route("couponsData.edit", ":id");
        $this->route->destroy = route("couponsData.destroy", ":id");
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

        $qry = $this->modal::offset($row)->take($rowperpage);

        if ($searchValue) {
            $qry->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('discount_code', 'like', '%' . $searchValue . '%')
                    ->orWhere('discount', 'like', '%' . $searchValue . '%');
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

            $location = array();
            if (!empty($row->locations)) {
                foreach (explode(',', $row->locations) as $id) {
                    $loc = Location::where('id', $id)->first();
                    if ($loc) {
                        $location[] = $loc['name'];
                    }
                }
            }

            $data[] = array(
                "sno" => $i,
                "name" => $row->name,
                "code" => $row->discount_code,
                "discount" => $row->discount . '%',
                "location" => implode(',', $location),
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

    public function create()
    {
        $locations = Location::get();

        return view('superadmin.' . $this->module . '.add', ['route' => $this->route, 'module' => $this->module, 'locations' => $locations]);
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
                    'discount' => 'required|numeric|min:0|not_in:0',
                    'discount_code' => 'required|alpha_num',
                    'location' => 'required',
                    'status'            => 'required'
                ]
            );

            if ($validator->fails()) {
                return $validator->validate();
            } else {
                $locations = implode(',', $request->location);

                $obj = $this->modal::firstOrNew(['id' => $id]);
                $obj->name = $request->name;
                $obj->discount_code = $request->discount_code;
                $obj->discount = $request->discount;
                $obj->locations = $locations;
                $obj->status = $request->status;
                $obj->save();
                return response()->json(['success' => 1, 'message' => $this->module . ' created successfully.']);
            }
        }
    }


    public function edit($id)
    {
        $info = $this->modal::find($id);
        $locations = Location::get();

        return view('superadmin.' . $this->module . '.edit', [
            'info' => $info,
            'route' => $this->route,
            'module' => $this->module,
            'locations' => $locations,
        ]);
    }

    public function update_data(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name'       => 'required',
                'discount' => 'required|numeric|min:0|not_in:0',
                'discount_code' => 'required|alpha_num',
                'location' => 'required',
                'status'            => 'required'
            ]
        );

        if ($validator->fails()) {
            return $validator->validate();
        } else {
            $locations = implode(',', $request->location);

            $obj = $this->modal::firstOrNew(['id' => $request->id]);
            $obj->name = $request->name;
            $obj->discount_code = $request->discount_code;
            $obj->discount = $request->discount;
            $obj->locations = $locations;
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
