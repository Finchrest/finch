<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Validator;
use App\Models\UploadImage;
use Illuminate\Support\Facades\Hash;

class LocationsController extends Controller
{
    protected $page;
    protected $module;
    protected $modal;
    protected $route;


    public function __construct()
    {
        $this->page = new \stdClass;
        $this->modal = 'App\Models\Location';
        $this->route = new \stdClass;
        $this->module = 'Location';
        $this->route->list = route('admin.locations.list');
        $this->route->add = route('locations.create');
        $this->route->store = route('locations.store');
        $this->route->upload_logo = route("locations.upload_logo");
        $this->route->edit = route("locations.edit", ":id");
        $this->route->destroy = route("locations.destroy", ":id");
        $this->route->upload = route("locations.upload");
        $this->route->status = route('admin.locations.status');
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
                $query->where('name', 'like', '%' . $searchValue . '%');
            });
        }
        $result = $qry->get();

        $data = array();
        $i = 1;
        foreach ($result as $row) {

            $status_url = $this->route->status;
            if ($row->status == 1) {
                $status = '<div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="switch2" checked="" onchange=status_change("' . $status_url . '",this,' . $row->id . ');>
  <label class="custom-control-label" for="switch2"></label>
</div>';
            } else {
                $status = '<div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="switch2" onchange=status_change("' . $status_url . '",this,' . $row->id . ');>
  <label class="custom-control-label" for="switch2"></label>
</div>';
            }

            $action = '';
            $edit_url = $this->route->edit;
            $destroy_url = $this->route->destroy;
            $action .= '<a href="#!" onclick=edit_row("' . $edit_url . '",' . $row->id . ');><i class="fa fa-edit"></i></a>';
            $action .= '&nbsp;&nbsp;<a href="#!" class="text-danger" onclick=delete_row("' . $destroy_url . '",' . $row->id . ')><i class="text-danger fa fa-trash"></i></a>';


            $file = '<img src="' . asset('images/no_image.jpg') . '"  class="img-thumbnail " alt="" width="50" height="50">';
            if ($row->FileId) {
                $file = '<img src="' . asset($row->FileId->file) . '"  class="img-thumbnail " alt="" width="50" height="50">';
            }

            $data[] = array(
                "sno" => $i,
                "name" => $file . ' ' . $row->name,
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
        return view('admin.' . $this->module . '.add', ['route' => $this->route, 'module' => $this->module]);
    }


    public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;
        $id = $request->id;
        if ($id) {
            return $this->update_data($request);
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'name'       => 'required',
                    'status'            => 'required',
                    'file_id'           => 'required',
                    'file_id_logo'           => 'required',
                    'allow_pincode.*'  => 'required'
                ],
                [
                    'allow_pincode.*.required' => 'The pincode field is required',
                    'file_id_logo.required' => 'The logo image field is required',
                ]
            );

            if ($validator->fails()) {
                return $validator->validate();
            } else {
                $pincode = implode(',', $request->allow_pincode);

                $obj = $this->modal::firstOrNew(['id' => $id]);
                $obj->name = $request->name;
                $obj->status = $request->status;
                $obj->file_id = $request->file_id;
                $obj->allow_pincode = $pincode;
                $obj->file_id_logo = $request->file_id_logo;
                $obj->save();
                return response()->json(['success' => 1, 'message' => $this->module . ' created successfully.']);
            }
        }
    }


    public function edit($id)
    {
        $info = $this->modal::find($id);
        return view('admin.' . $this->module . '.edit', [
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
                'status'            => 'required',
                'file_id_logo'           => 'required',
                'allow_pincode.*'  => 'required'
            ],
            [
                'allow_pincode.*.required' => 'The pincode field is required',
                'file_id_logo.required' => 'The logo image field is required',
            ]
        );

        if ($validator->fails()) {
            return $validator->validate();
        } else {
            $pincode = implode(',', $request->allow_pincode);
            $obj = $this->modal::firstOrNew(['id' => $request->id]);
            $obj->name = $request->name;
            $obj->status = $request->status;
            $obj->file_id = $request->file_id;
            $obj->allow_pincode = $pincode;
            $obj->file_id_logo = $request->file_id_logo;
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
    public function upload_logo(Request $request)
    {
        return uploadImage($request);
    }
    public function status(Request $request)
    {
        $status = $this->modal::find($request->id);
        $status->status = $request->status;
        $status->save();
        return response()->json(['success' => 1]);
    }
}
