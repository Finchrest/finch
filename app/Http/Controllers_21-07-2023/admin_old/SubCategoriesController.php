<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Validator;
use Illuminate\Support\Facades\Hash;

class SubCategoriesController extends Controller
{
	protected $page;
    protected $module;
    protected $modal;
    protected $route;
    

    public function __construct(){
        $this->page = new \stdClass;
        $this->modal = 'App\Models\SubCategory';
        $this->route = new \stdClass;
        $this->module = 'SubCategory';
        $this->route->list = route('admin.sub_categories.list');
        $this->route->add = route('sub_categories.create');
        $this->route->store = route('sub_categories.store');
        $this->route->edit = route("sub_categories.edit", ":id");
        $this->route->destroy = route("sub_categories.destroy", ":id");
	}
	
    public function index()
    {
        //echo $this->route->add;die;
		$this->page->title = 'Sub Category List';
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
			
		    $data[] = array(
                "sno"=>$i,
                "name"=>ucwords($row->name),
                "category"=>$row->Category->name,
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
        $categories = Category::get();
        return view('admin.'.$this->module.'.add', ['route'=>$this->route,'module'=>$this->module,'categories'=>$categories]);
    }


    public function store(Request $request)
    { 
        // echo '<pre>'; print_r($request->all()); die;
        $id = $request->id;
        if($id){
            return $this->update_data($request);
        }else{
            $validator =Validator::make($request->all(),
            [
                'name' => 'required',
                'category' => 'required',
                'status' => 'required'
            ]);
        
            if ($validator->fails()) {
                return $validator->validate();
            }else{ 
                $obj = $this->modal::firstOrNew(['id' =>$id]);
                $obj->name = $request->name;
                $obj->category_id = $request->category;
                $obj->status = $request->status;
                $obj->save();
                return response()->json(['success'=>1,'message'=>$this->module.' created successfully.']);
            }
        }
	}


    public function edit($id)
    {   
        $categories = Category::get();
        $info = $this->modal::find($id);
        return view('admin.'.$this->module.'.edit', [
            'info' => $info, 
            'route'=>$this->route,
            'module'=>$this->module,
            'categories'=>$categories
        ]);
    }

    public function update_data(Request $request)
    { 
        
        $validator =Validator::make($request->all(),
		[
            'name'       => 'required',
            'category' => 'required',
            'status'        	=> 'required'
        ]);
       
		if ($validator->fails()) {
            return $validator->validate();
        }else{  
            $obj = $this->modal::firstOrNew(['id' =>$request->id]);
            $obj->name = $request->name;
            $obj->category_id = $request->category;
            $obj->status = $request->status;
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

    public function setSubCategory(Request $request)
    {
        // echo '<pre>'; print_r($request->all()); die;
        $sub_categories = SubCategory::where('category_id',$request->category_id)->get();

        // echo '<pre>sub_categories - '; print_r($sub_categories); die;
        if(isset($request->type) && $request->type == 'edit'){
            $output = '<option value="" >Select</option>';
            if(!empty($sub_categories->toArray())){
                foreach($sub_categories as $sub_category){
                    if($request->sub_category_id == $sub_category->id){
                        $selected = 'selected';
                    }else{
                        $selected = '';
                    }
                    $output .= '<option value="'.$sub_category->id.'" '.$selected.'>'.ucwords($sub_category->name).'</option>';
                }
            }else{
                $output .= '<option value="">No sub category found on selected category.</option>';
            }
            return response()->json(['status'=>1,'opt'=>$output]);       
        }else{
            $output = '<option value="" >Select</option>';
            if(!empty($sub_categories->toArray())){
                foreach($sub_categories as $sub_category){
                    $output .= '<option value="'.$sub_category->id.'">'.ucwords($sub_category->name).'</option>';
                }
            }else{
                $output .= '<option value="">No sub category found on selected category.</option>';
            }
            return response()->json(['status'=>1,'opt'=>$output]);
        }
    }
	
}
