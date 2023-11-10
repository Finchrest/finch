<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\GeneralSetting;
use App\Models\Item;
use App\Models\Refund;
use Auth;
use DB;

class RestaurantController extends Controller
{
	protected $page;
 
    public function __construct(){
        $this->page = new \stdClass;
        $this->modal = 'App\Models\Order';
        $this->route = new \stdClass;
        $this->module = 'Order';
        // $this->route->list = route('restaurant.r_orders.list');
        $this->route->show = route("r_orders.show", ":id");
        $this->route->orderStatus = route("admin.orders.orderStatus", ":id");
        $this->route->changeStatus = route("restaurant.orders.changeStatus");
        $this->route->changeItemStatus = route("restaurant.orders.changeItemStatus");
        $this->route->refund_orders = route("restaurant.refund_orders");
        
	}
	
    public function index()
    {
		    $this->page->title = 'Dashboard';
        $date = date('Y-m-d');
        $totalRecords = $this->modal::where(['order_date'=>$date,'place_id'=>Auth::user()->id])->count();
        $sound = GeneralSetting::select('general_settings.*','upload_images.file as sound')->where('general_settings.id',7)->leftJoin('upload_images', 'upload_images.id', '=', 'general_settings.meta_value')->first();
        $Audio = $sound->sound;
      
        
        $date = date('Y-m-d');
        $getOrders = $this->modal::select('orders.*','items.product_id','locations.name as location_name','places.name as place_name')->where(['order_date'=>$date,'orders.status'=>1,'orders.order_status'=>0,'orders.place_id'=>Auth::user()->id])->leftJoin('locations','locations.id','=','orders.location')->leftJoin('places','places.id','=','orders.place_id')->leftJoin('items','items.order_id','=','orders.id')->groupBy('items.order_id')->get();



        return view('restaurant.dashboard', ['page' => $this->page,'sound'=>$Audio,'getOrders'=>$getOrders,'totalRecords'=>$totalRecords]);
    }
	

    public function list(Request $request)
    {
        //   echo"<pre>";print_r( $request->toArray());die;
      ## Read value
      $draw = $_POST['draw'];
      $row = $_POST['start'];
      $rowperpage = $_POST['length']; // Rows display per page
      $columnIndex = $_POST['order'][0]['column']; // Column index
      $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
      $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
      $searchValue = $_POST['search']['value']; // Search value
      $date = date('Y-m-d');
  
      $totalRecords = $this->modal::where(['order_date'=>$date,'orders.status'=>1,'place_id'=>Auth::user()->id])->count();
  
      $totalRecordwithFilter = $totalRecords;
     
        //   echo"<pre>";print_r( $date);die;
      $qry = $this->modal::offset($row)->take($rowperpage);
      $qry->select('orders.*', 'places.name as restaurantName');
      $qry->where(['order_date'=>$date,'orders.status'=>1,'place_id'=>Auth::user()->id]);
      $qry->leftJoin('places', 'places.id', '=', 'orders.place_id');
      $qry->orderby('orders.id', 'desc');

       
      if($searchValue){
        $qry->where(function ($query) use($searchValue) {
            $query->where('places.name', 'like', '%' . $searchValue . '%')
            ->orWhere('orders.email', 'like', '%' . $searchValue . '%');
        });
     }

      $result = $qry->get();

     
    //   echo"<pre>";print_r($result->toArray());die;
  
      $data = array();
      $i = 1;
      foreach ($result as $row) {
        if ($row->status == '1') {
          $status = 'Complete';
        } else {
          $status = 'Not Complete';
        }
        $order_status = '';
        $action = '';
        $show_url = $this->route->show;
        $orderStatus = $this->route->orderStatus;
        $changeStatus =  $this->route->changeStatus;
  
  
        if ($row->order_status == '1') {
          $order_status = 'Accepted';
        } elseif ($row->order_status == '2') {
          $order_status = 'Declined';
        } else {
          $order_status .= '<a href="javascript:void(0)" class="btn btn-success btn-sm" onclick=update_status("' . $changeStatus . '",' . $row->id . ',1);>Accept</a>  <a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick=update_status("' . $changeStatus . '",' . $row->id . ',2);>Decline</a>';
        }
      
  
  
        $shipping_address = '<small>';
        $shipping_address .= $row->name . '<br>';
        $shipping_address .= $row->phone . '<br>';
        $shipping_address .= $row->address . '<br>';
        $shipping_address .= $row->city . ', ' . $row->state . '<br>';
        $shipping_address .= '</small>';
  
        $data[] = array(
          "sno" => $i,
          "order_id" => '#' . $row->id,
          "user" => $row->User ? $row->User->name : '',
          "shipping_address" => $shipping_address,
          "qty" => $row->qty,
          "order_date" => $row->order_date,
          "status" => $status,

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

    public function getorder()
    {
      $date = date('Y-m-d');
      $totalRecords = $this->modal::where(['order_date'=>$date,'orders.status'=>1,'orders.order_status'=>0,'place_id'=>Auth::user()->id])->count();
  
      // echo"<pre>";print_r($totalRecords);die;
      return response()->json(['success'=>1,'message'=>'New Order','totalOrder'=>$totalRecords]);

    }


    public function getDashboredOrders()
    {
      // echo '<pre>'; print_r(Auth::user()->id);die;
      $date = date('Y-m-d');
      $getOrders = $this->modal::select('orders.*','items.product_id','locations.name as location_name','places.name as place_name','products.title as product_name','categories.name as cat_name','upload_images.file as image')->where(['order_date'=>$date,'orders.status'=>1,'orders.order_status'=>0,'place_id'=>Auth::user()->id])->leftJoin('locations','locations.id','=','orders.location')->leftJoin('places','places.id','=','orders.place_id')->leftJoin('items','items.order_id','=','orders.id')->groupBy('items.order_id')->leftJoin('products','products.id','=','items.product_id')->leftJoin('categories','categories.id','=','products.category')->leftJoin('upload_images','upload_images.id','=','products.file_id')->groupBy('items.order_id')->get();

     
      //  echo '<pre>'; print_r($getOrders->toArray());die;
      $view = view('restaurant.resatuarantorders', ['orders' => $getOrders])->render();
    

      return response()->json(['success'=>1,'message'=>'New Order','view'=>$view,'ordercount'=>count($getOrders)]);

    }

   
	
}

