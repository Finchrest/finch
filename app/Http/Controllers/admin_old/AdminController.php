<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Item;

class AdminController extends Controller
{
	protected $page;
 
    public function __construct(){
        $this->page = new \stdClass;
        $this->modal = 'App\Models\Order';
        $this->route = new \stdClass;
        $this->module = 'Order';
        $this->route->add = route('orders.create');
        $this->route->show = route("orders.show", ":id");
        $this->route->orderStatus = route("admin.orders.orderStatus", ":id");
        $this->route->changeStatus = route("admin.orders.changeStatus");
        $this->route->changeItemStatus = route("admin.orders.changeItemStatus");
        $this->route->refund_orders = route("admin.refund_orders");
        $this->route->refund_orders_list = route("admin.refund_orders_list");
	}
	
    public function index()
    {
		$this->page->title = 'Dashboard';
        return view('admin.dashboard', ['page' => $this->page]);
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
  
      $totalRecords = $this->modal::all()->where('order_date',$date)->count();
  
      $totalRecordwithFilter = $totalRecords;
     
        //   echo"<pre>";print_r( $date);die;
      $qry = $this->modal::offset($row)->take($rowperpage);
      $qry->select('orders.*', 'places.name as restaurantName');
      $qry->where('order_date',$date);
      $qry->leftJoin('places', 'places.id', '=', 'orders.place_id');
      $qry->orderby('orders.id', 'desc');
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
        $order_status = $order_for = '';
        $action = '';
        $show_url = $this->route->show;
        $orderStatus = $this->route->orderStatus;
        $changeStatus =  $this->route->changeStatus;
        
        if ($row->order_for == 1) {
          $order_for = 'Dine-In Order';
        } else {
          $order_for = 'Delivery Order';
        }
  
        if ($row->order_status == '1') {
          $order_status = 'Accepted';
        } elseif ($row->order_status == '2') {
          $order_status = 'Declined';
        } else {
          $order_status .= '<a href="javascript:void(0)" class="btn btn-success btn-sm" onclick=update_status("' . $changeStatus . '",' . $row->id . ',1);>Accept</a>  <a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick=update_status("' . $changeStatus . '",' . $row->id . ',2);>Decline</a>';
        }
        $action .= '<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick=show_row("' . $show_url . '",' . $row->id . ');><i class="fa fa-eye"></i></a>';
  
  
        $shipping_address = '<small>';
        $shipping_address .= $row->name . '<br>';
        $shipping_address .= $row->phone . '<br>';
        $shipping_address .= $row->address . '<br>';
        $shipping_address .= $row->city . ', ' . $row->state . '<br>';
        $shipping_address .= '</small>';
  
        $data[] = array(
          "sno" => $i,
          "order_id" => '#' . $row->id,
          "restaurant" => ucwords($row->restaurantName),
          "user" => $row->User ? $row->User->name : '',
          "shipping_address" => $shipping_address,
          "qty" => $row->qty,
          "total" => '₹' . $row->total,
          "order_date" => $row->order_date,
          "payment_date" => $row->payment_date,
          "status" => $status,
          "order_for" => $order_for,
          "order_status" => $order_status,
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
	
}
