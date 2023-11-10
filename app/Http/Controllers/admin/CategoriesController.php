<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\Hash;

class CategoriesController extends Controller
{
    protected $page;
    protected $module;
    protected $modal;
    protected $route;


    public function __construct()
    {
        $this->page = new \stdClass;
        $this->modal = 'App\Models\Category';
        $this->route = new \stdClass;
        $this->module = 'Category';
        $this->route->list = route('admin.categories.list');
        $this->route->add = route('categories.create');
        $this->route->store = route('categories.store');
        $this->route->edit = route("categories.edit", ":id");
        $this->route->destroy = route("categories.destroy", ":id");
        $this->route->status = route('admin.categories.status');
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

            $data[] = array(
                "sno" => $i,
                "name" => $row->name,
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
        $id = $request->id;
        if ($id) {
            return $this->update_data($request);
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'name'       => 'required',
                    'status'            => 'required'
                ]
            );

            if ($validator->fails()) {
                return $validator->validate();
            } else {
                $obj = $this->modal::firstOrNew(['id' => $id]);
                $obj->name = $request->name;
                $obj->status = $request->status;
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
                'status'            => 'required'
            ]
        );

        if ($validator->fails()) {
            return $validator->validate();
        } else {
            $obj = $this->modal::firstOrNew(['id' => $request->id]);
            $obj->name = $request->name;
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
    public function status(Request $request)
    {
        $status = $this->modal::find($request->id);
        $status->status = $request->status;
        $status->save();
        return response()->json(['success' => 1]);
    }
}
