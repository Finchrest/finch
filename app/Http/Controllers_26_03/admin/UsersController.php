<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
    

    public function __construct(){
        $this->page = new \stdClass;
        $this->modal = 'App\Models\User';
        $this->route = new \stdClass;
        $this->module = 'User';
        $this->route->list = route('admin.users.list');
        $this->route->add = route('users.create');
        $this->route->store = route('users.store');
        $this->route->edit = route("users.edit", ":id");
        $this->route->destroy = route("users.destroy", ":id");
	}
	
    public function index()
    {
        //echo $this->route->add;die;
		$this->page->title = $this->module.'s List';
        return view('admin.'.$this->module.'.index', ['page' => $this->page,'route'=>$this->route,'module'=>$this->module]);
    }
	
    public function user_enquiry_list()
    {
        //echo $this->route->add;die;
		$this->page->title = 'User Enquiry List';
        return view('admin.'.$this->module.'.user_enquiry', ['page' => $this->page,'route'=>$this->route,'module'=>$this->module]);
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
			
			if($row->is_old == '0'){   
                $isNew = 'New';   
            }else{  
               $isNew = 'Old';   
            }

			$action ='';
            $edit_url = $this->route->edit;
            $destroy_url = $this->route->destroy;
			$action .='<a href="#!" onclick=edit_row("'.$edit_url.'",'.$row->id.');><i class="fa fa-edit"></i></a>';
			$action .='&nbsp;&nbsp;<a href="#!" class="text-danger" onclick=delete_row("'.$destroy_url.'",'.$row->id.')><i class="text-danger fa fa-trash"></i></a>';
			
		    $data[] = array(
                "sno"=>$i,
                "name"=>$row->name,
                "email"=>$row->email,
                "phone"=>$row->phone,
                "status"=>$status,
                "user_type"=>$isNew,
                "created_at"=>date('Y-m-d h:i A',strtotime($row->created_at)),
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


        $totalRecords =UserEnquiry::all()->count();

       $totalRecordwithFilter =$totalRecords;
		
        $qry = UserEnquiry::offset($row)->take($rowperpage);
        $qry->orderBy('id','DESC');
      
	   $result=$qry->get();

        $data = array();
		$i=1;
        foreach ($result as $row) {
            if($row->status == '1'){   
                $status = 'Active';   
            }else{  
               $status = 'Inactive';   
            }
			
			if($row->is_old == '0'){   
                $isNew = 'New';   
            }else{  
               $isNew = 'Old';   
            }

			$action ='';
            $edit_url = $this->route->edit;
            $destroy_url = $this->route->destroy;
			$action .='<a href="#!" onclick=edit_row("'.$edit_url.'",'.$row->id.');><i class="fa fa-edit"></i></a>';
			$action .='&nbsp;&nbsp;<a href="#!" class="text-danger" onclick=delete_row("'.$destroy_url.'",'.$row->id.')><i class="text-danger fa fa-trash"></i></a>';
			
		    $data[] = array(
                "sno"=>$i,
                "name"=>$row->name,
                "email"=>$row->email,
                "phone"=>$row->phone,
                "message"=>$row->message,
                "created_at"=>date('Y-m-d h:i A',strtotime($row->created_at)),
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
        return view('admin.'.$this->module.'.add', ['route'=>$this->route,'module'=>$this->module]);
    }


    public function store(Request $request)
    { 
        $id = $request->id;
        if($id){ 
            return $this->update_data($request);
        }else{
            $validator =Validator::make($request->all(),
            [
                'name'       => 'required',
                'email'  		=> 'required|email|unique:users',
                'phone'  		=> 'required|digits:10|unique:users',
                'password'        	=> 'required',
                'is_new'        	=> 'required',
                'status'        	=> 'required'
            ]);
        
            if ($validator->fails()) {
                return $validator->validate();
            }else{ 
                $obj = $this->modal::firstOrNew(['id' =>$id]);
                $obj->name = $request->name;
                $obj->email = $request->email;
                $obj->phone = $request->phone;
                $obj->password = Hash::make($request->password);
                $obj->is_old = $request->is_new;
                $obj->status = $request->status;
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
            'name'       => 'required',
            'email'  		=> 'required|email|unique:users,email,'.$request->id,
            'phone'  		=> 'required|unique:users,phone,'.$request->id,
            'is_new'        	=> 'required',
            'status'        	=> 'required'
        ]);
       
		if ($validator->fails()) {
            return $validator->validate();
        }else{   
            $obj = $this->modal::firstOrNew(['id' =>$request->id]);
            $obj->name = $request->name;
            $obj->email = $request->email;
            $obj->phone = $request->phone;
            if($request->password){
               $obj->password = Hash::make($request->password);
            }
            $obj->status = $request->status;
			$obj->is_old = $request->is_new;
            $obj->save();
           
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
