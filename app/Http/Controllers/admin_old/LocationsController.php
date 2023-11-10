<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Validator;
use Illuminate\Support\Facades\Hash;

class LocationsController extends Controller
{
	protected $page;
    protected $module;
    protected $modal;
    protected $route;
    

    public function __construct(){
        $this->page = new \stdClass;
        $this->modal = 'App\Models\Location';
        $this->route = new \stdClass;
        $this->module = 'Location';
        $this->route->list = route('admin.locations.list');
        $this->route->add = route('locations.create');
        $this->route->store = route('locations.store');
        $this->route->edit = route("locations.edit", ":id");
        $this->route->destroy = route("locations.destroy", ":id");
        $this->route->upload = route("offers.upload");
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
			$action .='&nbsp;&nbsp;<a href="#!" class="text-danger" onclick=delete_row("'.$destroy_url.'",'.$row->id.')><i class="text-danger fa fa-trash"></i></a>';
			

             $file='<img src="'.asset('images/no_image.jpg').'"  class="img-thumbnail " alt="" width="50" height="50">';
                if($row->FileId){
                    $file='<img src="'.asset($row->FileId->file).'"  class="img-thumbnail " alt="" width="50" height="50">';
                }

		    $data[] = array(
                "sno"=>$i,
                "name"=>$file.' '.$row->name,
                "status"=>$status,
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
                'status'        	=> 'required',
                'file_id'        	=> 'required'
            ]);
        
            if ($validator->fails()) {
                return $validator->validate();
            }else{ 
                $pincode = implode(',',$request->allow_pincode);

                $obj = $this->modal::firstOrNew(['id' =>$id]);
                $obj->name = $request->name;
                $obj->status = $request->status;
                $obj->file_id = $request->file_id;
                $obj->allow_pincode = $pincode;
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
            'status'        	=> 'required',
            'file_id'        	=> 'required'
        ]);
       
		if ($validator->fails()) {
            return $validator->validate();
        }else{  
            $pincode = implode(',',$request->allow_pincode);
            $obj = $this->modal::firstOrNew(['id' =>$request->id]);
            $obj->name = $request->name;
            $obj->status = $request->status;
            $obj->file_id = $request->file_id;
            $obj->allow_pincode = $pincode;
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

    public function upload(Request $request)
    {
       $type = $request->type;
       $path = $type.'_path';
       $name = $type.'_name';
       $file_path = $request->$path;
       $file_name = $request->$name;
		$ext_arr= array('jpg','png','jpeg'); 
		if(!empty($request->file($file_name))){ 
		  //Move Uploaded File
		  $file = $request->file($file_name);
		  $ext = $file->getClientOriginalExtension();
		  if(in_array($ext,$ext_arr)){
		  $destinationPath = public_path().'/'.$file_path;
		  $file_name = time()."_".$file->getClientOriginalName();
		  $file->move($destinationPath,$file_name);
        
		  $file_data = UploadImage::create([
				'file'          => $file_path.$file_name, 
				]);

			return response()->json(['status'=>1,'file_id'=>$file_data->id,'file_path'=>asset($file_data->file)]);
		  }else{
			  return response()->json(['status'=>0,'msg'=>'File type not allowed']);
		  }
		}
		
    }
	
}
