<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PassportOrder;
use App\Models\PassportOrderHistory;
use App\Models\Order;
use App\Models\User;
use App\Models\Passport;
use App\Models\PassportUsedOrder;
use Validator;
use DB;
use Illuminate\Support\Facades\Hash;
use Helper;

class CustomPassportOrdersController extends Controller
{
	protected $page;
    protected $module;
    protected $modal;
    protected $route;
    

    public function __construct(){
        $this->page = new \stdClass;
        $this->modal = 'App\Models\PassportOrder';
        $this->route = new \stdClass;
        $this->module = 'CustomPassportOrder';
        $this->route->list = route('admin.custom_passport_orders.list');
        $this->route->add = route('custom_passport_orders.create');
        $this->route->store = route('custom_passport_orders.store');
        $this->route->show = route("custom_passport_orders.show", ":id");
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


        $totalRecords =$this->modal::all()->where('is_custom',1)->count();

       $totalRecordwithFilter =$totalRecords;
		
        $qry = $this->modal::offset($row)->take($rowperpage);
       
      
	   $result=$qry->where('is_custom',1)->get();

        $data = array();
		$i=1;
        foreach ($result as $row) {
            if($row->status == '1'){   
                $status = 'Complete';   
            }else{  
               $status = 'Not Complete';   
            }

			$action ='';
            $show_url = $this->route->show;
           $action .='<a href="#!" onclick=show_row("'.$show_url.'",'.$row->id.');><i class="fa fa-eye"></i></a>';
			
		    $data[] = array(
                "sno"=>$i,
                "order_id"=>'#'.$row->id,
                "passport_code"=>'#'.$row->passport_code,
                "user"=>$row->User->name .'<br>'.$row->User->phone,
                "price"=>'₹'.$row->price,
                "volume"=>'₹'.$row->volume_amount,
                "remaining"=>'₹'.$row->remaining_amount,
                "validity"=>$row->start_date.' - '.$row->end_date,
                "order_date"=>$row->order_date,
                "payment_date"=>$row->payment_date,
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
	
	public function show($id)
    {   
        $info = $this->modal::find($id);
        $items=array();
        $order_data=array();
         $passportOrder = PassportOrder::select('id','passport_code','passport_id','name','phone','email','price','payment_id','order_date','payment_date','volume_amount','used_amount','remaining_amount')->where('id',$id)->first()->toArray();
            $order_data['order'] = $passportOrder; 
             $passport_code =$passportOrder['passport_code'];
             
              $items = PassportUsedOrder::select('order_type','order_date','amount')->where('passport_code',$passport_code)->get(); 
            
             
             $i=0;      
              foreach($items as $item){    
					$order_data['order']['items'][$i]['order_date']=date('d/m/Y',strtotime($item->order_date));
                    $order_data['order']['items'][$i]['amount']=$item->amount;
                    $order_type='Direct';
                    if($item->order_type == 1){
                        $order_type='Online order';
                    }
					
					 if($item->order_type == 2){
                        $order_type='Custom order';
                    }
					
                    $order_data['order']['items'][$i]['order_type']=$order_type;

                $i++;
                }
            
			//echo '<pre>';print_R($order_data);die;
        
        return view('admin.'.$this->module.'.show', [
            'info' => $order_data, 
            'route'=>$this->route,
            'module'=>$this->module
        ]);
    }


    public function create()
    {  

        $users = User::where('is_old',1)->get();
        $passports = Passport::where('is_old',1)->get();
        return view('admin.'.$this->module.'.add', 
            [
            'route'=>$this->route,
            'module'=>$this->module,
            'users'=>$users,
            'passports'=>$passports,

            ]);
    }


    public function store(Request $request)
    { 
  // echo"<pre>";print_r($_POST);die;
        $id = $request->id;
        if($id){
            return $this->update_data($request);
        }else{
            $validator =Validator::make($request->all(),
            [
                'user_id'       => 'required',
                'name' => 'required',
                'phone' => 'required',
                'email'   => 'required',
                'passport'   => 'required',
                'volume'   => 'required',
                'date'   => 'required',
            ]);
        
            if ($validator->fails()) {
                return $validator->validate();
            }else{ 

                $passport_code = generatePassportCode();
				$start_date = $request->date;
				$date = strtotime($start_date);
				$date = strtotime("+1 years", $date);
				$end_date = date('Y-m-d', $date);
				

                $obj = $this->modal::firstOrNew(['id' =>$id]);
                $obj->name = $request->name;
                $obj->phone = $request->phone;
                $obj->email = $request->email;
                $obj->status ='1';
                $obj->order_date =$request->date;
                $obj->start_date =$start_date;
                $obj->end_date = $end_date;
                $obj->user_id = $request->user_id;
                $obj->price = $request->price;
                $obj->passport_code =  $passport_code;
                $obj->passport_id = $request->passport;
                $obj->volume_amount = $request->volume;
                $obj->used_amount = 0;
                $obj->remaining_amount = $request->volume;
                $obj->is_custom = 1;
                $obj->save();
                $pid = $obj->id;
                $pay_data_hstry = array(
                    'passport_order_id' => $pid,
                    'user_id' => $request->user_id,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'price'=>$request->price,
                    'passport_id'=>$request->passport,
                    'status'=>1,
                    'volume_amount'=>$request->volume,
                    'used_amount' => 0,
                    'remaining_amount' => $request->volume,
                    'order_date' => $request->date,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'is_custom' => 1
                   
                );
                PassportOrderHistory::insert($pay_data_hstry);
                return response()->json(['success'=>1,'message'=>$this->module.' created successfully.']);
            }
        }
    }

     public function getPassportVolume1(Request $request)
    {   
       //echo '<pre>'; print_r($request->all()); die;
        $passport = Passport::where('id',$request->id)->first();
      //echo '<pre>passport - '; print_r($passport); die;

      return response()->json(['success'=>1,'vol'=>$passport->volume,'price'=>$passport->price]);
    }


    public function getUserdetail1(Request $request)
    {   
        // echo '<pre>'; print_r($request->all()); die;
        $users = User::where('id',$request->id)->first();
        //echo '<pre>passport - '; print_r($users); die;

      return response()->json(['success'=>1,'name'=>$users->name,'phone'=>$users->phone,'email'=>$users->email]);
    }
    

}
