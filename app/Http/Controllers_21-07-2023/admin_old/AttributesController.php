<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Hop;
use App\Models\Malt;
use App\Models\Ptype;
use App\Models\UploadImage;
use App\Models\Location;
use App\Models\Place;
use Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

class AttributesController extends Controller
{
    protected $page;
    protected $module;
    protected $modal;
    protected $route;
    

    public function __construct(){
        $this->page = new \stdClass;
        $this->modal = 'App\Models\Attribute';
        $this->route = new \stdClass;
        $this->module = 'Attribute';
        $this->route->list = route('admin.attributes.list');
        $this->route->add = route('attributes.create');
        $this->route->store = route('attributes.store');
        $this->route->edit = route("attributes.edit", ":id");
        $this->route->destroy = route("attributes.destroy", ":id");
    }
    
    public function index()
    {
        //echo $this->route->add;die;
        $this->page->title = $this->module.'s List';
        return view('admin.'.$this->module.'.index', ['page' => $this->page,'route'=>$this->route,'module'=>$this->module]);
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

        $totalRecords = $this->modal::count();

       $totalRecordwithFilter = $totalRecords;
        
        $qry = $this->modal::select('attributes.id', 'attributes.name', 'attributes.status')->offset($row)->take($rowperpage);
        $qry->groupBy('attributes.id');
        $qry->groupBy('attributes.name');
        $qry->groupBy('attributes.status');
        $qry->selectRaw('GROUP_CONCAT(attribute_options.option_name) as options');

        if($searchValue){
            $qry->where(function ($query) use($searchValue) {
                $query->where('attributes.name', 'like', '%' . $searchValue . '%');
            });
         }
         
        $qry->leftJoin('attribute_options','attribute_options.attr_id','=','attributes.id');
        //$qry->where('attributes.id',Auth::user()->id);
        
        $qry->orderBy('attributes.id','ASC');
      
       $result=$qry->get();

        $data = array();
        $i=1;
        // echo '<pre>result - '; print_r($result->toArray()); die;
        foreach ($result as $row) {
            if($row->status == '1'){   
                $status = 'Active';   
            }else{  
               $status = 'Inactive';   
            }

            $action ='';
            $edit_url = $this->route->edit;
            $destroy_url = $this->route->destroy;
            $action .='<a href="#!" onclick=edit_row("'.$edit_url.'",'.$row->id.');><i class="fa fa-edit"></i></a>';
            $action .='&nbsp;&nbsp;<a href="#!" class="text-danger" onclick=delete_row("'.$destroy_url.'",'.$row->id.')><i class="text-danger fa fa-trash"></i></a>';

            $data[] = array(
                "sno"=>$i,
                "name"=>$row->name,
                "options"=>$row->options,
                "status"=>$status,
                "action"=>$action, 
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
        return view('admin.'.$this->module.'.add', [
            'route'=>$this->route,
            'module'=>$this->module,
        ]);
    }

    public function store(Request $request)
    { 
        $id = $request->id;
        if($id){
            return $this->update_data($request);
        }else{
                $validator =Validator::make($request->all(),
                [
                    'name'          => 'required',
                    'status'   => 'required'
                ]);
            }
        
            if ($validator->fails()) {
                return $validator->validate();
            }else{ 
                $id =1;

                $obj = $this->modal::firstOrNew(
                    [
                        'name' => $request->name,
                        'status' => $request->status,
                        'is_delete' => 0,
                        'created_at' => date('Y-m-d h:i A', time()),
                        'updated_at' => date('Y-m-d h:i A', time()),
                    ]
                );
                $obj->save();

                $attr_id = $obj->id;

                $attribute_option = $request->attribute_option;
                foreach($attribute_option as $option) {
                    $obj2 = AttributeOption::firstOrNew(
                        [
                            'option_name' => $option,
                            'attr_id' => $attr_id,
                            'is_delete' => 0,
                            'created_at' => date('Y-m-d h:i A', time()),
                            'updated_at' => date('Y-m-d h:i A', time()),
                        ]
                    );
                    $obj2->save();
                }

                return response()->json(['success'=>1,'message'=>$this->module.' created successfully.']);
        }
    }


    public function edit($id)
    {   
        $info = $this->modal::find($id);
        $qry = AttributeOption::select('option_name')->where('attr_id', $id);
        $result=$qry->get();
        $options_arr = $result->toArray();
        $options = '';
        foreach($options_arr as $option) {
            $options .= $option['option_name'].',';
        }
        $options = rtrim($options, ',');

        //echo '<pre>result - '; print_r($result->toArray()); die;
        //echo '<pre>'; print_r($options); die;
        return view('admin.'.$this->module.'.edit', [
            'info' => $info, 
            'options' => $options, 
            'route'=>$this->route,
            'module'=>$this->module
        ]);
    }

    public function update_data(Request $request)
    { 
        $validator =Validator::make($request->all(),
        [
            'name'          => 'required',
            'status'   => 'required',
        ]);
            
        if ($validator->fails()) {
            return $validator->validate();
        }else{  
            $attr_id = $request->id;
            $obj = $this->modal::firstOrNew(['id' => $attr_id]);
            $obj->name = $request->name;
            $obj->status = $request->status;
            $obj->updated_at = date('Y-m-d h:i A', time());
            $obj->save();

            $options_qry = AttributeOption::select('*')->where('attr_id', $attr_id);
            $options_qry->delete();

            $attribute_option = $request->attribute_option;
            foreach($attribute_option as $option) {
                $obj2 = AttributeOption::firstOrNew(
                    [
                        'option_name' => $option,
                        'attr_id' => $attr_id,
                        'is_delete' => 0,
                        'created_at' => date('Y-m-d h:i A', time()),
                        'updated_at' => date('Y-m-d h:i A', time()),
                    ]
                );
                $obj2->save();
            }

            return response()->json(['success'=>1,'message'=>$this->module.' updated successfully.']);
        }
    }


    public function destroy($id)
    {
        $user = $this->modal::find($id);
        $user->delete();
        return response()->json(['success'=>1,'message'=>$this->module.' delete successfully.']);
    }
    
}
