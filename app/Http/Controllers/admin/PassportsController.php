<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Passport;
use App\Models\Place;
use App\Models\Product;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\UploadImage;
use App\Models\Location;
use Illuminate\Support\Str;
use Helper;

class PassportsController extends Controller
{
    protected $page;
    protected $module;
    protected $modal;
    protected $route;


    public function __construct()
    {
        $this->page = new \stdClass;
        $this->modal = 'App\Models\Passport';
        $this->route = new \stdClass;
        $this->module = 'Passport';
        $this->route->list = route('admin.passports.list');
        $this->route->add = route('passports.create');
        $this->route->store = route('passports.store');
        $this->route->edit = route("passports.edit", ":id");
        $this->route->destroy = route("passports.destroy", ":id");
        $this->route->upload = route("passports.upload");
    }

    public function index()
    {
        //echo $this->route->add;die;
        $this->page->title = $this->module . 's List';
        return view('admin.' . $this->module . '.index', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module]);
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
                    ->orWhere('price', 'like', '%' . $searchValue . '%')
                    ->orWhere('tax', 'like', '%' . $searchValue . '%');
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

            if ($row->is_old == '1') {
                $is_old = 'Old';
            } else {
                $is_old = 'New';
            }

            $action = '';
            $edit_url = $this->route->edit;
            $destroy_url = $this->route->destroy;
            $action .= '<a href="#!" onclick=edit_row("' . $edit_url . '",' . $row->id . ');><i class="fa fa-edit"></i></a>';
            $action .= '&nbsp;&nbsp;<a href="#!" class="text-danger" onclick=delete_row("' . $destroy_url . '",' . $row->id . ')><i class="text-danger fa fa-trash"></i></a>';
            $action .= '<br>&nbsp;&nbsp;<a href="'.route('admin.passportFreeItems',$row->id).'" class="btn btn-primary">Free Products</a>';

            $file = '<img src="' . asset('images/no_image.jpg') . '"  class="img-thumbnail " alt="" width="50" height="50">';
            if ($row->FileId) {
                $file = '<img src="' . asset($row->FileId->file) . '"  class="img-thumbnail " alt="" width="50" height="50">';
            }

            $data[] = array(
                "sno" => $i,
                "name" => $file . ' ' . $row->name,
                "location" => $row->Location->name,
                "sub_total" => '₹' . $row->sub_total,
                "tax" => $row->tax . '%',
                "price" => '₹' . $row->price,
                "volume" => '₹' . $row->volume,
                "status" => $status,
                "type" => $is_old,
                "created_at" => date('Y-m-d h:i A', strtotime($row->created_at)),
                "action" => $action,
            );
            // echo "<pre>"; print_r($data);die;
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
        $passportId = generatePassportId();
        return view('admin.' . $this->module . '.add', ['route' => $this->route, 'module' => $this->module, 'locations' => $locations, 'passportId' => $passportId]);
    }



    public function store(Request $request)
    {
        // echo '<pre>store request - '; print_r($request->all()); die;
        $id = $request->id;
        if ($id) {
            return $this->update_data($request);
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'name'       => 'required',
                    'sub_description'           => 'required',
                    'description'            => 'required',
                    'location'            => 'required',
                    'status'            => 'required',
                    'file_id'           => 'required',
                    'sub_total'         => 'required|numeric|min:8000',
                    'tax'           => 'required',
                    'price'         => 'required',
                    'per_day_use'           => 'required',
                    'volume'            => 'required',
                ]
            );

            if ($validator->fails()) {
                return $validator->validate();
            } else {

                $obj = $this->modal::firstOrNew(['id' => $id]);
                $obj->passport_id = $request->passport_id;
                $obj->name = $request->name;
                $obj->slug = Str::slug($request->name);
                $obj->sub_description = $request->sub_description;
                $obj->description = $request->description;
                $obj->location = $request->location;
                $obj->sub_total = $request->sub_total;
                $obj->tax = $request->tax;
                $obj->price = $request->price;
                $obj->volume = $request->volume;
                $obj->per_day_use = $request->per_day_use;
                $obj->is_old = $request->is_new;
                $obj->file_id = $request->file_id;

                $obj->status = $request->status;
                $obj->save();
                return response()->json(['success' => 1, 'message' => $this->module . ' created successfully.']);
            }
        }
    }


    public function edit($id)
    {
        $info = $this->modal::find($id);
        $files = UploadImage::whereIn('id', explode(',', $info->file_ids))->get();
        $file_view = view('admin.multi_image.index', ['files' => $files, 'route' => $this->route])->render();;
        $locations = Location::get();
        return view('admin.' . $this->module . '.edit', [
            'info' => $info,
            'route' => $this->route,
            'module' => $this->module,
            'file_view' => $file_view,
            'locations' => $locations,
        ]);
    }

    public function update_data(Request $request)
    {
        // echo '<pre>update_data request - '; print_r($request->all()); die;
        $validator = Validator::make(
            $request->all(),
            [
                'name'       => 'required',
                'sub_description'           => 'required',
                'description'            => 'required',
                'location'            => 'required',
                'status'            => 'required',
                'status'            => 'required',
                'file_id'           => 'required',
                'sub_total'         => 'required|numeric|min:8000',
                'tax'           => 'required',
                'price'         => 'required',
                'volume'            => 'required',
                'per_day_use'           => 'required',
            ]
        );

        if ($validator->fails()) {
            return $validator->validate();
        } else {

            $obj = $this->modal::firstOrNew(['id' => $request->id]);
            $obj->passport_id = $request->passport_id;
            $obj->name = $request->name;
            $obj->sub_description = $request->sub_description;
            $obj->description = $request->description;
            $obj->location = $request->location;
            $obj->sub_total = $request->sub_total;
            $obj->tax = $request->tax;
            $obj->price = $request->price;
            $obj->volume = $request->volume;
            $obj->file_id = $request->file_id;
            $obj->per_day_use = $request->per_day_use;
            $obj->is_old = $request->is_new;
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


    public function upload(Request $request)
    {
        return uploadImage($request);
    }
}
