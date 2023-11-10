<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\UploadImage;
use App\Models\Location;
use Illuminate\Support\Str;

class PlacesController extends Controller
{
	protected $page;
    protected $module;
    protected $modal;
    protected $route;
    

    public function __construct(){
        $this->page = new \stdClass;
        $this->modal = 'App\Models\Place';
        $this->route = new \stdClass;
        $this->module = 'Place';
        $this->route->list = route('admin.places.list');
        $this->route->add = route('places.create');
        $this->route->store = route('places.store');
        $this->route->edit = route("places.edit", ":id");
        $this->route->destroy = route("places.destroy", ":id");
        $this->route->upload = route("places.upload");
        $this->route->multiple_upload = route("places.multiple_upload");
        $this->route->multiple_upload_delete = route("places.multiple_upload_delete");
        
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
                    $file='<img src="'.asset($row->IconId->file).'"  class="img-thumbnail " alt="" width="50" height="50">';
                }

		    $data[] = array(
                "sno"=>$i,
                "name"=>$file.' '.$row->name,
                "location"=>$row->Location->name,
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
        $locations = Location::get();
        return view('admin.'.$this->module.'.add', ['route'=>$this->route,'module'=>$this->module,'locations'=>$locations]);
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
                'sub_description'        	=> 'required',
                'description'            => 'required',
                'location'            => 'required',
                'status'            => 'required',
                'file_id'        	=> 'required',
                'icon_id'   => 'required',
                'file_ids'        	=> 'required',
            ]);
        
            if ($validator->fails()) {
                return $validator->validate();
            }else{ 
                $obj = $this->modal::firstOrNew(['id' =>$id]);
                $obj->name = $request->name;
                $obj->slug = Str::slug($request->name);
                $obj->sub_description = $request->sub_description;
                $obj->description = $request->description;
                $obj->location = $request->location;
                $obj->file_id = $request->file_id;
                $obj->file_ids = $request->file_ids;
                $obj->icon_id = $request->icon_id;
                $obj->status = $request->status;
                $obj->save();
                return response()->json(['success'=>1,'message'=>$this->module.' created successfully.']);
            }
        }
	}


    public function edit($id)
    {   
        $info = $this->modal::find($id);
        $files = UploadImage::whereIn('id',explode(',',$info->file_ids))->get();
        $file_view = view('admin.multi_image.index', ['files'=>$files,'route'=>$this->route])->render();;
        $locations = Location::get();
        return view('admin.'.$this->module.'.edit', [
            'info' => $info, 
            'route'=>$this->route,
            'module'=>$this->module,
            'file_view'=>$file_view,
            'locations'=>$locations,
        ]);
    }

    public function update_data(Request $request)
    { 
        // echo '<pre>obj - '; print_r($request->all()); die;
        $validator =Validator::make($request->all(),
		[
            'name'       => 'required',
            'sub_description'        	=> 'required',
            'description'            => 'required',
            'location'            => 'required',
            'status'            => 'required',
            'status'        	=> 'required',
            'file_id'        	=> 'required',
            'icon_id'   => 'required',
            'file_ids'        	=> 'required',
        ]);
       
		if ($validator->fails()) {
            return $validator->validate();
        }else{  
            $obj = $this->modal::firstOrNew(['id' =>$request->id]);
            $obj->name = $request->name;
            $obj->sub_description = $request->sub_description;
            $obj->description = $request->description;
            $obj->location = $request->location;
            $obj->file_id = $request->file_id;
            $obj->file_ids = $request->file_ids;
            $obj->icon_id = $request->icon_id;
            $obj->status = $request->status;

            // echo '<pre>obj - '; print_r($obj); die;
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
		$ext_arr= array('jpg','png','jpeg','JPG','PNG','JPEG'); 
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


    public function multiple_upload(Request $request)
    {
       $type = $request->type;
       $path = $type.'_path';
       $name = $type.'_name';
       $file_path = $request->$path;
       $file_name = $request->$name;
		$ext_arr= array('jpg','png','jpeg','JPG','PNG','JPEG'); 
        $ids=array();
		if(!empty($request->file($file_name))){ 
            $files=$request->file($file_name);
            foreach($files as $file){
               $destinationPath = public_path().'/'.$file_path;
		       $file_name = time()."_".$file->getClientOriginalName();
		       $file->move($destinationPath,$file_name);
               $file_data = UploadImage::create([
				'file'          => $file_path.$file_name, 
				]);
                $ids[]=$file_data->id;
            }
            
            $input_file_ids = explode(',',$request->file_ids);
            $ids = array_filter(array_merge($ids,$input_file_ids));
            $files = UploadImage::whereIn('id',$ids)->get();
            $file_view = view('admin.multi_image.index', ['files'=>$files,'route'=>$this->route])->render();;

            $im_ids = implode(',',$ids);
			return response()->json(['status'=>1,'file_view'=>$file_view,'file_ids'=>$im_ids]);
		  }else{
			  return response()->json(['status'=>0,'msg'=>'File type not allowed']);
		  }
		
    }


    public function multiple_upload_delete(Request $request)
    { 
        $id = $request->id;
        $ids = explode(',',$request->ids);
        $ids = array_values(array_diff($ids, array($id)));
        return implode(',',$ids);
    }
	
}
