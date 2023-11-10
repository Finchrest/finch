<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\UploadImage;

class AdminController extends Controller
{
    protected $page;
    protected $module;
    protected $modal;
    protected $route;


    public function __construct()
    {
        $this->page = new \stdClass;
        $this->modal = 'App\Models\Admin';
        $this->route = new \stdClass;
        $this->module = 'Admin';
        $this->route->list = route('superadmin.admins.list');
        $this->route->add = route('adminsData.create');
        $this->route->store = route('adminsData.store');
        $this->route->edit = route("adminsData.edit", ":id");
        $this->route->destroy = route("adminsData.destroy", ":id");
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


        $result = $qry->get();

        $data = array();
        $i = 1;
        foreach ($result as $row) {


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
                "name" => $row->name,
                "email" => $row->email,
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
                ]
            );

            if ($validator->fails()) {
                return $validator->validate();
            } else {
                $obj = $this->modal::firstOrNew(['id' => $id]);
                $obj->name = $request->name;
                $obj->email_verified_at = date("Y-m-d h:i:s");
                $obj->email = $request->email;
                $obj->password = Hash::make($request->password);
                $obj->remember_token = Hash::make(rand());
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
                'email'      => 'required|email|unique:users,email,' . $request->id,
                'name'       => 'required',
            ]
        );

        if ($validator->fails()) {
            return $validator->validate();
        } else {
            $obj = $this->modal::firstOrNew(['id' => $request->id]);
            $obj->name = $request->name;
            $obj->email = $request->email;
            if ($request->password) {
                $obj->password = Hash::make($request->password);
            }
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
        $type = $request->type;
        $path = $type . '_path';
        $name = $type . '_name';
        $file_path = $request->$path;
        $file_name = $request->$name;
        $ext_arr = array('jpg', 'png', 'jpeg');
        if (!empty($request->file($file_name))) {
            //Move Uploaded File
            $file = $request->file($file_name);
            $ext = $file->getClientOriginalExtension();
            if (in_array($ext, $ext_arr)) {
                $destinationPath = public_path() . '/' . $file_path;
                $file_name = time() . "_" . $file->getClientOriginalName();
                $file->move($destinationPath, $file_name);

                $file_data = UploadImage::create([
                    'file'          => $file_path . $file_name,
                ]);

                return response()->json(['status' => 1, 'file_id' => $file_data->id, 'file_path' => asset($file_data->file)]);
            } else {
                return response()->json(['status' => 0, 'msg' => 'File type not allowed']);
            }
        }
    }
}
