<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PassportPage;
use Validator;
use Illuminate\Support\Facades\Hash;

class PassportPagesController extends Controller
{
	protected $page;
    protected $module;
    protected $modal;
    protected $route;
    

    public function __construct(){
        $this->page = new \stdClass;
        $this->modal = 'App\Models\PassportPage';
        $this->route = new \stdClass;
        $this->module = 'PassportPage';
        $this->route->list = route('admin.passport_pages.list');
        $this->route->add = route('passport_pages.create');
        $this->route->store = route('passport_pages.store');
        $this->route->edit = route("passport_pages.edit", ":id");
        $this->route->destroy = route("passport_pages.destroy", ":id");
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


        $totalRecords =$this->modal::all()->count();

       $totalRecordwithFilter =$totalRecords;
		
        $qry = $this->modal::offset($row)->take($rowperpage);
       
      
	   $result=$qry->get();

        $data = array();
		$i=1;
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
			
		    $data[] = array(
                "sno"=>$i,
                "name"=>$row->name,
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
	
	
    public function store(Request $request)
    { 
        $id = $request->id;
        if($id){
            return $this->update_data($request);
        }else{
            $validator =Validator::make($request->all(),
            [
                'description'       => 'required',
             ]);
        
            if ($validator->fails()) {
                return $validator->validate();
            }else{ 
                $obj = $this->modal::firstOrNew(['id' =>$id]);
                $obj->description = $request->description;
                $obj->save();
                return response()->json(['success'=>1,'message'=>$this->module.' created successfully.']);
            }
        }
	}


    public function edit($id)
    {   
        $info = $this->modal::find($id);
        return view('admin.'.$this->module.'.edit', [
            'info' => $info, 
            'route'=>$this->route,
            'module'=>$this->module
        ]);
    }

    public function update_data(Request $request)
    { 
        
        $validator =Validator::make($request->all(),
		[
            'description'       => 'required',
        ]);
       
		if ($validator->fails()) {
            return $validator->validate();
        }else{  
            $obj = $this->modal::firstOrNew(['id' =>$request->id]);
            $obj->description = $request->description;
            $obj->save();
            return response()->json(['success'=>1,'message'=>$this->module.' updated successfully.']);
		}
	}

}