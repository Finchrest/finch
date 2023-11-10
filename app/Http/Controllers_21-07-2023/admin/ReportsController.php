<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Item;
use App\Models\Refund;
use Razorpay\Api\Api;
use DB;
use App\Models\Place;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ReportsController extends Controller
{
    protected $page;
    protected $module;
    protected $modal;
    protected $route;
    protected $refund_module;
    protected $refund_orders;
    protected $refund_orders_list;
    

    public function __construct(){
        $this->page = new \stdClass;
        $this->modal = 'App\Models\Order';
        $this->route = new \stdClass;
        $this->module = 'Reports';
        // $this->module = 'Order';
        $this->route->list = route('admin.reports');
        // $this->route->list = route('admin.restaurants.list');
        // $this->route->add = route('restaurants.create');
        // $this->route->store = route('restaurants.store');
        // $this->route->edit = route("restaurants.edit", ":id");
        // $this->route->destroy = route("restaurants.destroy", ":id");
        // $this->route->upload = route("restaurants.upload");
        // $this->route->multiple_upload = route("restaurants.multiple_upload");
        // $this->route->multiple_upload_delete = route("restaurants.multiple_upload_delete");
        
  }
  
    public function index(){
        $this->page->title = 'Reports';
        return view('admin.'.$this->module.'.index', ['page' => $this->page,'route'=>$this->route,'module'=>$this->module]);
    }

    public function totalOrderReports() {
      $this->page->title = $this->module . ' Reports';

      $restaurants = Place::all();

      return view('admin.' . $this->module . '.totalOrders', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module, 'restaurants' => $restaurants]);
    }

    public function totalSalesReports() {

      $this->page->title = $this->module . ' Reports';

      $restaurants = Place::all();

      return view('admin.' . $this->module . '.totalSales', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module, 'restaurants' => $restaurants]);
    }

    public function topProductsReports() {
      $this->page->title = $this->module . ' Reports';

      $restaurants = Place::all();

      return view('admin.' . $this->module . '.topProducts', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module, 'restaurants' => $restaurants]);
    }

    public function totalAvrageOrderReports() {

      $this->page->title = $this->module . ' Reports';

      $restaurants = Place::all();
      
      return view('admin.' . $this->module . '.averageOrder', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module, 'restaurants' => $restaurants]);
    }

    public function totalRejectedReports() {
      $this->page->title = $this->module . ' Reports';

      $restaurants = Place::all();

      return view('admin.' . $this->module . '.totalRejectOrder', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module, 'restaurants' => $restaurants]);
    }

    public function repeatCustomersReports() {
      $this->page->title = $this->module . ' Reports';

      $restaurants = Place::all();

      return view('admin.' . $this->module . '.repeatCustomers', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module, 'restaurants' => $restaurants]);
    }

    public function abandonedOrderReports() {
      $this->page->title = $this->module . ' Reports';

      $restaurants = Place::all();

      return view('admin.' . $this->module . '.abandonedOrderDetails', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module, 'restaurants' => $restaurants]);
    }

  public function totalOrderList(Request $request){
    //echo "string";die;
    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    $totalRecords = $this->modal::select('orders.*')->leftJoin('places', 'places.id', '=', 'orders.place_id');

    $qry = $this->modal::select('orders.*', 'places.name as restaurantName');
    $qry->leftJoin('places', 'places.id', '=', 'orders.place_id');
    

    if ($searchValue) {
      $totalRecords->where('places.name', 'LIKE', '%'.$searchValue.'%');
      $qry->where('places.name', 'LIKE', '%'.$searchValue.'%');
    }
     if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }
    if ($request->orderStatus) {

      $order_status = $request->orderStatus;
      if ($order_status == 2) {
        $totalRecords->where('orders.order_status', 2);
        $qry->where('orders.order_status', 2);
        $status = 'Cancelled';
      } else if ($order_status == 3) {
        $totalRecords->where('orders.order_status', 0);
        $qry->where('orders.order_status', 0);
        $status = 'Complimentary';
      } else if ($order_status == 4) {
        $totalRecords->where('orders.order_status', 1);
        $qry->where('orders.order_status', 1);
        $status = 'Success';
      } else {
        $status = 'All';
      }
    }
    if ($request->orderRestaurants > 0) {
      $totalRecords->where('orders.place_id', '=', $request->orderRestaurants);
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }

    //$totalRecords;
   

    $totalRecordwithFilter = $totalRecords->count();

    $qry->offset($row)->take($rowperpage);
    $qry->orderby('orders.id', 'desc');
    $result = $qry->get();

    $data = array();
    $i = 1;
    foreach ($result as $row) {
      if ($row->status == '1') {
        $status = 'Complete';
      } elseif ($row->status == '2') {
        $status = 'Cancelled';
      } else {
        $status = 'Pending';
      }
      
      $shipping_address = '<small>';
      $shipping_address .= $row->name . '<br>';
      $shipping_address .= $row->phone . '<br>';
      $shipping_address .= $row->address . '<br>';
      $shipping_address .= $row->city . ', ' . $row->state . '<br>';
      $shipping_address .= '</small>';
      $tax = $row->total - $row->sub_total;
      $delivery_charge = 0;

      $data[] = array(
        "sno" => $i,
        "order_id" => '#' . $row->id,
        "restaurant" => ucwords($row->restaurantName),
        "user" => $row->User ? $row->User->name : '',
        "phone" => $row->User ? $row->User->phone : '-',
        "shipping_address" => $shipping_address,
        "qty" => $row->qty,
        "sub_total" => '₹' . $row->sub_total,
        "total" => '₹' . $row->total,
        "tax" => '₹' . $tax,
        "discount" => '₹' . $row->coupon_amount,
        "delivery_charge" => '₹' .$delivery_charge,
        "order_date" => $row->order_date,
        "payment_type" => $row->payment_date,
        "status" => $status,
        "created_at" => date('Y-m-d h:i A', strtotime($row->created_at)),
      );

      $i++;
    }
    ## Response
    $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecordwithFilter,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $data
    );

    echo json_encode($response);
  }  

  public function totalSalesList(Request $request){
    //echo "string";die;
    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    $info = array();

    /*$orders = DB::table('orders')->select(DB::raw('SUM(total) as sales_total'))->select('places.name as restaurant')->leftJoin('places', 'places.id', '=', 'orders.place_id')->groupBy('orders.place_id')->toSql();
    dd($orders);
    die;*/

    /*$qry = $this->modal::offset($row)->take($rowperpage);
    $qry->select('orders.*', 'places.name as restaurantName');
    $qry->leftJoin('places', 'places.id', '=', 'orders.place_id');

    if ($searchValue) {
      $qry->where('places.name', 'LIKE', '%'.$searchValue.'%');
    }

    $qry->orderby('orders.id', 'desc');
    $result = $qry->get();*/

    $status = 'All';
    $latests_date = $this->modal::latest()->get()->toArray();
    $oldest_date = $this->modal::oldest()->get()->toArray();
    $from_date = date('d-m-Y', strtotime($oldest_date[0]['order_date']));
    $to_date = date('d-m-Y', strtotime($latests_date[0]['order_date']));

    $totalRecords = $this->modal::select('orders.*', 'places.name as restaurantName')->leftJoin('places', 'places.id', '=', 'orders.place_id')->orderby('orders.id', 'desc');  
    $total_orders = $this->modal::select('orders.*', 'places.name as restaurantName')->leftJoin('places', 'places.id', '=', 'orders.place_id')->orderby('orders.id', 'desc');

    if ($searchValue) {
      $totalRecords->where('places.name', 'LIKE', '%'.$searchValue.'%');
      $total_orders->where('places.name', 'LIKE', '%'.$searchValue.'%');
    }
    if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      //$totalRecords->whereBetween('order_date', [$from_date, $to_date]);
      //$qry->whereBetween('order_date', [$from_date, $to_date]);
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $total_orders->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      //$totalRecords->whereBetween('order_date', [$from_date, $to_date]);
      //$qry->whereBetween('order_date', [$from_date, $to_date]);
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $total_orders->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }
    if ($request->orderStatus) {

      $order_status = $request->orderStatus;
      if ($order_status == 2) {
        $totalRecords->where('orders.order_status', 2);
        $total_orders->where('orders.order_status', 2);
        $status = 'Cancelled';
      } else if ($order_status == 3) {
        $totalRecords->where('orders.order_status', 0);
        $total_orders->where('orders.order_status', 0);
        $status = 'Complimentary';
      } else if ($order_status == 4) {
        $totalRecords->where('orders.order_status', 1);
        $total_orders->where('orders.order_status', 1);
        $status = 'Success';
      } else {
        $status = 'All';
      }
    }
    if ($request->orderRestaurants > 0) {
      $totalRecords->where('orders.place_id', '=', $request->orderRestaurants);
      $total_orders->where('orders.place_id', '=', $request->orderRestaurants);
    }

    $totalRecordwithFilter = $totalRecords->count();

    $total_orders->offset($row)->take($rowperpage);
    $orders = $total_orders->get();

      $delivery_charge = 0;
      $count = 0;
      foreach ($orders as $key => $order) {
        $restaurant_name = $order->restaurantName;
        $restaurant_id = $order->place_id;
        $order_total = $order->total;
        $order_item_qty = $order->qty;
        $order_tax = $order_total - $order->sub_total;
        $coupon_discount = $order->coupon_amount;

        //echo $restaurant_exists = $this->findKeyMultiple($info, 'restaurant_id', $restaurant_id);

        if (array_key_exists($restaurant_id, $info)) {
          $info[$restaurant_id]['total_sales'] += $order_item_qty;
          $info[$restaurant_id]['total_amount'] += $order_total;
          $info[$restaurant_id]['total_tax'] += $order_tax;
          $info[$restaurant_id]['coupon_discount'] += $coupon_discount;
          $info[$restaurant_id]['num_of_bills'] += 1;

          
          $count++;
        } else {
          $info[$restaurant_id]['restaurant_name'] = $restaurant_name;
          $info[$restaurant_id]['total_sales'] = $order_item_qty;
          $info[$restaurant_id]['total_amount'] = $order_total;
          $info[$restaurant_id]['num_of_bills'] = 1;
          $info[$restaurant_id]['coupon_discount'] = $coupon_discount;
          $info[$restaurant_id]['total_tax'] = $order_tax;
        }


        /*if ($restaurant_exists < 0) {
          $info[$count]['restaurant_id'] = $restaurant_id;
          $info[$count]['restaurant_name'] = $restaurant_name;
          $info[$count]['total_sales'] = $order_total;
          $count++;

        } else {
          //$info[$restaurant_exists]['restaurant_name'] = $restaurant_name;
          //$info[$restaurant_exists]['total_sales'] = $info[$restaurant_exists]['total_sales'] + $order_total;
        }*/
        
      }

    $data = array();
    $i = 1;

    foreach ($info as $row) {
      $data[] = array(
        "sno" => $i,
        "restaurant" => ucwords($row['restaurant_name']),
        "total_sales" => $row['total_sales'],        
        "num_of_bills" => $row['num_of_bills'],  
        "total_amount" => '₹' . $row['total_amount'], 
        "tax" => '₹' . $row['total_tax'], 
        "discount" => '₹' . $row['coupon_discount'], 
        "delivery_charge" => '₹' . $delivery_charge,
        "date_range" => $from_date.' - '.$to_date,
        "status" => $status,
      );

      $i++;
    }
    ## Response
    $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => count($info),
      "iTotalDisplayRecords" => count($info),
      "aaData" => $data
    );

    echo json_encode($response);
  }  

 public function topProductList(Request $request){
    //echo "string";die;
    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    $totalRecords = DB::table('items')->selectRaw('SUM(orders.total) AS order_total, categories.name AS category_name, products.title AS product_title, users.name AS user_name, users.phone AS user_phone, product_id, SUM(items.price) AS item_total, SUM(items.qty) AS item_qty, orders.name, orders.phone, orders.address, orders.city, orders.state, places.name as restaurantName')
    ->leftJoin('orders', 'orders.id', '=', 'items.order_id')
    ->leftJoin('places', 'places.id', '=', 'orders.place_id')
    ->leftJoin('users', 'users.id', '=', 'items.user_id')
    ->leftJoin('products', 'items.product_id', '=', 'products.id')
    ->leftJoin('categories', 'products.category', '=', 'categories.id')
    ->groupBy('product_id', 'orders.name', 'orders.phone', 'orders.address', 'orders.city', 'orders.state', 'restaurantName', 'user_name', 'user_phone', 'product_title', 'category_name')
    ->orderByDesc('item_qty');

    $qry = DB::table('items')->selectRaw('SUM(orders.total) AS order_total, categories.name AS category_name, products.title AS product_title, users.name AS user_name, users.phone AS user_phone, product_id, SUM(items.price) AS item_total, SUM(items.qty) AS item_qty, orders.name, orders.phone, orders.address, orders.city, orders.state, places.name as restaurantName')
    ->leftJoin('orders', 'orders.id', '=', 'items.order_id')
    ->leftJoin('places', 'places.id', '=', 'orders.place_id')
    ->leftJoin('users', 'users.id', '=', 'items.user_id')
    ->leftJoin('products', 'items.product_id', '=', 'products.id')
    ->leftJoin('categories', 'products.category', '=', 'categories.id')
    ->groupBy('product_id', 'orders.name', 'orders.phone', 'orders.address', 'orders.city', 'orders.state', 'restaurantName', 'user_name', 'user_phone', 'product_title', 'category_name')
    ->orderByDesc('item_qty')
    ->offset($row)->take($rowperpage);

    if ($searchValue) {
      $totalRecords->where('places.name', 'LIKE', '%'.$searchValue.'%');
      $qry->where('places.name', 'LIKE', '%'.$searchValue.'%');
    }
  if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      //$totalRecords->whereBetween('order_date', [$from_date, $to_date]);
      //$qry->whereBetween('order_date', [$from_date, $to_date]);
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      //$totalRecords->whereBetween('order_date', [$from_date, $to_date]);
      //$qry->whereBetween('order_date', [$from_date, $to_date]);
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }
    if ($request->orderStatus) {
      $order_status = $request->orderStatus;
      if ($order_status == 2) {
        $totalRecords->where('orders.order_status', 2);
        $qry->where('orders.order_status', 2);
        $status = 'Cancelled';
      } else if ($order_status == 3) {
        $totalRecords->where('orders.order_status', 0);
        $qry->where('orders.order_status', 0);
        $status = 'Complimentary';
      } else if ($order_status == 4) {
        $totalRecords->where('orders.order_status', 1);
        $qry->where('orders.order_status', 1);
        $status = 'Success';
      } else {
        $status = 'All';
      }
    }
    if ($request->orderRestaurants > 0) {
      $totalRecords->where('orders.place_id', '=', $request->orderRestaurants);
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }

    $result = $qry->get();
     
    
    $totalRecordsFilter = $totalRecords->get()->count();

    $data = array();
    $i = 1;
    foreach ($result as $row) {     
      $shipping_address = '<small>';
      $shipping_address .= $row->name . '<br>';
      $shipping_address .= $row->phone . '<br>';
      $shipping_address .= $row->address . '<br>';
      $shipping_address .= $row->city . ', ' . $row->state . '<br>';
      $shipping_address .= '</small>';

      $data[] = array(
        "sno" => $i,
        "restaurant" => ucwords($row->restaurantName),  
        'product_title'   => $row->product_title,
        'category' => $row->category_name,
        "qty" => $row->item_qty,    
        "item_total" => '₹' . $row->item_total,
        "user" => $row->user_name,
        "phone" => $row->user_phone,
        "shipping_address" => $shipping_address,
        "order_total" => '₹' . $row->order_total,
      );

      $i++;
    }
    ## Response
    $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecordsFilter,
      "iTotalDisplayRecords" => $totalRecordsFilter,
      "aaData" => $data
    );

    echo json_encode($response);
  }  


 public function averageOrderList(Request $request){
    //echo "string";die;
    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    $totalRecords = DB::table('orders')->selectRaw('AVG(orders.total) AS order_avg, COUNT(orders.id) AS orders_count, places.name as restaurantName, SUM(orders.total) AS order_total, SUM(orders.sub_total) AS order_subtotal, AVG(orders.coupon_amount) AS discount_avg')
    ->leftJoin('places', 'places.id', '=', 'orders.place_id')
    ->groupBy('orders.place_id', 'places.name')
    ->orderByDesc('order_avg');

    $qry = DB::table('orders')->selectRaw('AVG(orders.total) AS order_avg, COUNT(orders.id) AS orders_count, places.name as restaurantName, SUM(orders.total) AS order_total, SUM(orders.sub_total) AS order_subtotal, AVG(orders.coupon_amount) AS discount_avg')
    ->leftJoin('places', 'places.id', '=', 'orders.place_id')
    ->groupBy('orders.place_id', 'places.name')
    ->orderByDesc('order_avg')
    ->offset($row)->take($rowperpage);

    if ($searchValue) {
      $totalRecords->where('places.name', 'LIKE', '%'.$searchValue.'%');
      $qry->where('places.name', 'LIKE', '%'.$searchValue.'%');
    }
    if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      //$totalRecords->whereBetween('order_date', [$from_date, $to_date]);
      //$qry->whereBetween('order_date', [$from_date, $to_date]);
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      //$totalRecords->whereBetween('order_date', [$from_date, $to_date]);
      //$qry->whereBetween('order_date', [$from_date, $to_date]);
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }
    if ($request->orderStatus) {
      $order_status = $request->orderStatus;
      if ($order_status == 2) {
        $totalRecords->where('orders.order_status', 2);
        $qry->where('orders.order_status', 2);
        $status = 'Cancelled';
      } else if ($order_status == 3) {
        $totalRecords->where('orders.order_status', 0);
        $qry->where('orders.order_status', 0);
        $status = 'Complimentary';
      } else if ($order_status == 4) {
        $totalRecords->where('orders.order_status', 1);
        $qry->where('orders.order_status', 1);
        $status = 'Success';
      } else {
        $status = 'All';
      }
    }
    if ($request->orderRestaurants > 0) {
      $totalRecords->where('orders.place_id', '=', $request->orderRestaurants);
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }

    $result = $qry->get();

    $totalRecordsFilter = $totalRecords->get()->count();

    $data = array();
    $i = 1;
    foreach ($result as $row) {
      $order_avg = number_format($row->order_avg, 2);
      $tax_total = $row->order_total - $row->order_subtotal;
      $tax_avg = $tax_total / $row->orders_count;
      $tax_avg = number_format($tax_avg, 2);
      $discount_avg = number_format($row->discount_avg, 2);
      $delivery_charge = 0;

      $data[] = array(
        "sno" => $i,
        "restaurant" => ucwords($row->restaurantName),
        "orders_count" => $row->orders_count,
        "order_avg" => '₹' . $order_avg,
        "tax" => '₹' . $tax_avg,
        "discount" => '₹' . $discount_avg,
        "delivery_charge" => '₹' . $delivery_charge
      );

      $i++;
    }
    ## Response
    $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecordsFilter,
      "iTotalDisplayRecords" => $totalRecordsFilter,
      "aaData" => $data
    );

    echo json_encode($response);
  }  


  public function totalRejectedOrderList(Request $request){
    //echo "string";die;
    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    $totalRecords = $this->modal::select('orders.*')->leftJoin('places', 'places.id', '=', 'orders.place_id')->where('orders.order_status', 2);
    $qry = $this->modal::select('orders.*', 'places.name as restaurantName');
    $qry->leftJoin('places', 'places.id', '=', 'orders.place_id')->where('orders.order_status', 2);
    

    if ($searchValue) {
      $totalRecords->where('places.name', 'LIKE', '%'.$searchValue.'%');
      $qry->where('places.name', 'LIKE', '%'.$searchValue.'%');
    }
    if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }
    if ($request->orderRestaurants > 0) {
      $totalRecords->where('orders.place_id', '=', $request->orderRestaurants);
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }

    //$totalRecords;
    

    $totalRecordwithFilter = $totalRecords->count();

    $qry->offset($row)->take($rowperpage);
    $qry->orderby('orders.id', 'desc');
    $result = $qry->get();
    $reason = '';

    $data = array();
    $i = 1;
    foreach ($result as $row) {
     
      $shipping_address = '<small>';
      $shipping_address .= $row->name . '<br>';
      $shipping_address .= $row->phone . '<br>';
      $shipping_address .= $row->address . '<br>';
      $shipping_address .= $row->city . ', ' . $row->state . '<br>';
      $shipping_address .= '</small>';
      $tax = $row->total - $row->sub_total;
      $delivery_charge = 0;

      $data[] = array(
        "sno" => $i,
        "order_id" => '#' . $row->id,
        "restaurant" => ucwords($row->restaurantName),
        "user" => $row->User ? $row->User->name : '',
        "phone" => $row->User ? $row->User->phone : '-',
        "shipping_address" => $shipping_address,
        "qty" => $row->qty,
        "sub_total" => '₹' . $row->sub_total,
        "total" => '₹' . $row->total,
        "tax" => '₹' . $tax,
        "discount" => '₹' . $row->coupon_amount,
        "delivery_charge" => '₹' .$delivery_charge,
        "order_date" => $row->order_date,
        "payment_type" => $row->payment_date,
        "reason" => $reason,
        "created_at" => date('Y-m-d h:i A', strtotime($row->created_at)),
      );

      $i++;
    }
    ## Response
    $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecordwithFilter,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $data
    );

    echo json_encode($response);
  }  

  public function repeatCustomerList(Request $request){
    //echo "string";die;
    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    $totalRecords = DB::table('orders')->selectRaw('places.name as restaurantName, COUNT(orders.id) AS orders_count, users.name AS user_name, users.phone AS user_phone,  users.email AS user_email, SUM(orders.total) AS order_total, SUM(orders.sub_total) AS order_subtotal, SUM(orders.total_pay) AS amount_pay, SUM(orders.sub_total) AS order_subtotal')
    ->leftJoin('places', 'places.id', '=', 'orders.place_id')
    ->leftJoin('users', 'users.id', '=', 'orders.user_id')
    ->groupBy('orders.user_id', 'users.name', 'users.phone', 'users.email', 'places.name');
    //->orderByDesc('orders_count');
    

    $qry = DB::table('orders')->selectRaw('places.name as restaurantName, COUNT(orders.id) AS orders_count, users.name AS user_name, users.phone AS user_phone,  users.email AS user_email, SUM(orders.total) AS order_total, SUM(orders.sub_total) AS order_subtotal, SUM(orders.total_pay) AS amount_pay, SUM(orders.sub_total) AS order_subtotal')
    ->leftJoin('places', 'places.id', '=', 'orders.place_id')
    ->leftJoin('users', 'users.id', '=', 'orders.user_id')
    ->groupBy('orders.user_id', 'users.name', 'users.phone', 'users.email', 'places.name')
    ->orderByDesc('orders_count');
    
    
    $status = 'All';
    if ($searchValue) {
      $totalRecords->where('places.name', 'LIKE', '%'.$searchValue.'%');
      $qry->where('places.name', 'LIKE', '%'.$searchValue.'%');
    }
   if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }
    if ($request->orderStatus) {

      $order_status = $request->orderStatus;
      if ($order_status == 2) {
        $totalRecords->where('orders.order_status', 2);
        $qry->where('orders.order_status', 2);
        $status = 'Cancelled';
      } else if ($order_status == 3) {
        $totalRecords->where('orders.order_status', 0);
        $qry->where('orders.order_status', 0);
        $status = 'Complimentary';
      } else if ($order_status == 4) {
        $totalRecords->where('orders.order_status', 1);
        $qry->where('orders.order_status', 1);
        $status = 'Success';
      } else {
        $status = 'All';
      }
    }
    if ($request->orderRestaurants > 0) {
      $totalRecords->where('orders.place_id', '=', $request->orderRestaurants);
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }

    $totalRecordwithFilter = $totalRecords->count();

    $qry->offset($row)->take($rowperpage);
    //$qry->orderby('orders.id', 'desc');
    $result = $qry->get();

    $data = array();
    $i = 1;
    foreach ($result as $row) {     
      $total_tax = $row->order_total - $row->order_subtotal;
      $delivery_charge = 0;

      $data[] = array(
        "sno" => $i,
        "restaurant" => ucwords($row->restaurantName),
        "qty" => $row->orders_count,
        "user" => $row->user_name,
        "phone" => $row->user_phone,
        "email" => $row->user_email,
        "amount_pay" => '₹' . $row->amount_pay,
        "total" => '₹' . $row->order_total,
        "delivery_charge" => '₹' . $row->order_total,
        "discount" => '₹' . $row->order_total,
        "tax" => $total_tax,
        "payment_date" => $delivery_charge,
        "status" => $status,
      );

      $i++;
    }
    ## Response
    $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecordwithFilter,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $data
    );

    echo json_encode($response);
  }  

  public function abandonedOrderList(Request $request){
    //echo "string";die;
    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    $totalRecords = $this->modal::select('orders.*', 'users.email AS user_email', 'users.name AS user_name', 'users.phone AS user_phone')
    ->leftJoin('users', 'users.id', '=', 'orders.user_id')
    ->where('orders.order_status', 2);
    $qry = $this->modal::select('orders.*', 'users.email AS user_email', 'users.name AS user_name', 'users.phone AS user_phone')
    ->leftJoin('users', 'orders.user_id', '=', 'users.id')
    ->where('orders.order_status', 2);
    

    if ($searchValue) {
      $totalRecords->where('users.name', 'LIKE', '%'.$searchValue.'%');
      $qry->where('users.name', 'LIKE', '%'.$searchValue.'%');
    }
    if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      //$totalRecords->whereBetween('order_date', [$from_date, $to_date]);
      //$qry->whereBetween('order_date', [$from_date, $to_date]);
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      
      

    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      //$totalRecords->whereBetween('order_date', [$from_date, $to_date]);
      //$qry->whereBetween('order_date', [$from_date, $to_date]);
      $totalRecords->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }
    if ($request->orderRestaurants > 0) {
      $totalRecords->where('orders.place_id', '=', $request->orderRestaurants);
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }

    //$totalRecords;

    $totalRecordwithFilter = $totalRecords->count();

    $qry->offset($row)->take($rowperpage);
    $qry->orderby('orders.id', 'desc');
    $result = $qry->get();

    $data = array();
    $i = 1;
    foreach ($result as $row) {

      if ($row->pay_status == '1') {
        $pay_status = 'Complete';
      } elseif ($row->pay_status == '2') {
        $pay_status = 'Cancelled';
      } else {
        $pay_status = 'Pending';
      }

      $order_status = '';
      $data[] = array(
        "sno" => $i,
        "user" => $row->user_name,
        "phone" => $row->user_phone,
        "email" => $row->user_email,
        "pay_status" => $pay_status,
      );

      $i++;
    }

    ## Response
    $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecordwithFilter,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $data
    );

    echo json_encode($response);
  }

  public function totalOrderListExport(Request $request){

    $qry = $this->modal::select('orders.*', 'places.name as restaurantName');
    $qry->leftJoin('places', 'places.id', '=', 'orders.place_id');
    
   

    if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }
    if ($request->orderRestaurants > 0) {
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }

    if ($request->orderStatus) {

      $order_status = $request->orderStatus;
      if ($order_status == 2) {
        $qry->where('orders.order_status', 2);
        $status = 'Cancelled';
      } else if ($order_status == 3) {
        $qry->where('orders.order_status', 0);
        $status = 'Complimentary';
      } else if ($order_status == 4) {
        $qry->where('orders.order_status', 1);
        $status = 'Success';
      } else {
        $status = 'All';
      }
    }
    if ($request->orderRestaurants > 0) {
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }

    $qry->orderby('orders.id', 'desc');
    $result = $qry->get();

    $data = array();
    $i = 1;
    foreach ($result as $row) {
      if ($row->status == '1') {
        $status = 'Complete';
      } elseif ($row->status == '2') {
        $status = 'Cancelled';
      } else {
        $status = 'Pending';
      }
      
      $shipping_address = '<small>';
      $shipping_address .= $row->name . '<br>';
      $shipping_address .= $row->phone . '<br>';
      $shipping_address .= $row->address . '<br>';
      $shipping_address .= $row->city . ', ' . $row->state . '<br>';
      $shipping_address .= '</small>';
      $tax = $row->total - $row->sub_total;
      $delivery_charge = 0;

      $data[] = array(
        "sno" => $i,
        "order_id" => '#' . $row->id,
        "restaurant" => ucwords($row->restaurantName),
        "user" => $row->User ? $row->User->name : '',
        "phone" => $row->User ? $row->User->phone : '-',
        "shipping_address" => $shipping_address,
        "qty" => $row->qty,
        "sub_total" => '₹' . $row->sub_total,
        "total" => '₹' . $row->total,
        "tax" => '₹' . $tax,
        "discount" => '₹' . $row->coupon_amount,
        "delivery_charge" => '₹' .$delivery_charge,
        "order_date" => $row->order_date,
        "payment_type" => $row->payment_date,
        "status" => $status,
      );

      $i++;
    }

    try {
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $count = 1;
      $sheet->setCellValue('A'.$count, 'Order ID');
      $sheet->setCellValue('B'.$count, 'Restaurant');
      $sheet->setCellValue('C'.$count, 'User Name');
      $sheet->setCellValue('D'.$count, 'User Phone');
      $sheet->setCellValue('E'.$count, 'Shipping Address');
      $sheet->setCellValue('F'.$count, 'Qty');
      $sheet->setCellValue('G'.$count, 'Order Subtotal');
      $sheet->setCellValue('H'.$count, 'Order Total');
      $sheet->setCellValue('I'.$count, 'Tax');
      $sheet->setCellValue('J'.$count, 'Discount');
      $sheet->setCellValue('K'.$count, 'Delivery Charge');
      $sheet->setCellValue('L'.$count, 'Order Date');
      $sheet->setCellValue('M'.$count, 'Payment Type');
      $sheet->setCellValue('N'.$count, 'Status');
      $count++;

      foreach ($data as $key => $row) {
        //$row['order_id'];
        $sheet->setCellValue('A'.$count, $row['order_id']);
        $sheet->setCellValue('B'.$count, $row['restaurant']);
        $sheet->setCellValue('C'.$count, $row['user']);
        $sheet->setCellValue('D'.$count, $row['phone']);
        $sheet->setCellValue('E'.$count, $row['shipping_address']);
        $sheet->setCellValue('F'.$count, $row['qty']);
        $sheet->setCellValue('G'.$count, $row['sub_total']);
        $sheet->setCellValue('H'.$count, $row['total']);
        $sheet->setCellValue('I'.$count, $row['tax']);
        $sheet->setCellValue('J'.$count, $row['discount']);
        $sheet->setCellValue('K'.$count, $row['delivery_charge']);
        $sheet->setCellValue('L'.$count, $row['order_date']);
        $sheet->setCellValue('M'.$count, $row['payment_type']);
        $sheet->setCellValue('N'.$count, $row['status']);
        $count++;
      }     

      $file_name = 'total-orders-'.date('d-m-Y-H-i-s').'.xlsx';
      $file_path = public_path().'/upload/reports/'.$file_name;
      $writer = new Xlsx($spreadsheet);

      ob_start();
      $writer->save("php://output");
      $xlsData = ob_get_contents();
      ob_end_clean();

      $response =  array(
        'op' => 'ok',
        'name' => $file_name,
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData)
      );

      echo json_encode($response);

    } catch(Exception $e) {
        exit($e->getMessage());
    }

  }

  public function totalSalesListExport(Request $request){

    $status = 'All';
    $info = array();

    $qry = $this->modal::select('orders.*', 'places.name as restaurantName');
    $qry->leftJoin('places', 'places.id', '=', 'orders.place_id');
    
    $latests_date = $this->modal::latest()->get()->toArray();
    $oldest_date = $this->modal::oldest()->get()->toArray();
    $from_date = date('d-m-Y', strtotime($oldest_date[0]['order_date']));
    $to_date = date('d-m-Y', strtotime($latests_date[0]['order_date']));
    $total_orders = $this->modal::select('orders.*', 'places.name as restaurantName')->leftJoin('places', 'places.id', '=', 'orders.place_id')->orderby('orders.id', 'desc');

     if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }
    if ($request->orderRestaurants > 0) {
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }
    if ($request->orderStatus) {
      $order_status = $request->orderStatus;
      if ($order_status == 2) {
        $total_orders->where('orders.order_status', 2);
        $status = 'Cancelled';
      } else if ($order_status == 3) {
        $total_orders->where('orders.order_status', 0);
        $status = 'Complimentary';
      } else if ($order_status == 4) {
        $total_orders->where('orders.order_status', 1);
        $status = 'Success';
      } else {
        $status = 'All';
      }
    }
    if ($request->orderRestaurants > 0) {
      $total_orders->where('orders.place_id', '=', $request->orderRestaurants);
    }

    $orders = $total_orders->get();

    $delivery_charge = 0;
    $count = 0;
    foreach ($orders as $key => $order) {
      $restaurant_name = $order->restaurantName;
      $restaurant_id = $order->place_id;
      $order_total = $order->total;
      $order_item_qty = $order->qty;
      $order_tax = $order_total - $order->sub_total;
      $coupon_discount = $order->coupon_amount;

      if (array_key_exists($restaurant_id, $info)) {
        $info[$restaurant_id]['total_sales'] += $order_item_qty;
        $info[$restaurant_id]['total_amount'] += $order_total;
        $info[$restaurant_id]['total_tax'] += $order_tax;
        $info[$restaurant_id]['coupon_discount'] += $coupon_discount;
        $info[$restaurant_id]['num_of_bills'] += 1;        
        $count++;
      } else {
        $info[$restaurant_id]['restaurant_name'] = $restaurant_name;
        $info[$restaurant_id]['total_sales'] = $order_item_qty;
        $info[$restaurant_id]['total_amount'] = $order_total;
        $info[$restaurant_id]['num_of_bills'] = 1;
        $info[$restaurant_id]['coupon_discount'] = $coupon_discount;
        $info[$restaurant_id]['total_tax'] = $order_tax;
      }
    }

    $data = array();
    $i = 1;

    foreach ($info as $row) {
      $data[] = array(
        "sno" => $i,
        "restaurant" => ucwords($row['restaurant_name']),
        "total_sales" => $row['total_sales'],        
        "num_of_bills" => $row['num_of_bills'],  
        "total_amount" => '₹' . $row['total_amount'], 
        "tax" => '₹' . $row['total_tax'], 
        "discount" => '₹' . $row['coupon_discount'], 
        "delivery_charge" => '₹' . $delivery_charge,
        "date_range" => $from_date.' - '.$to_date,
        "status" => $status,
      );

      $i++;
    }

    try {
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $count = 1;
      $sheet->setCellValue('A'.$count, 'Restaurant');
      $sheet->setCellValue('B'.$count, 'Total Sales');
      $sheet->setCellValue('C'.$count, 'No of Bills');
      $sheet->setCellValue('D'.$count, 'Total Amount');
      $sheet->setCellValue('E'.$count, 'Tax');
      $sheet->setCellValue('F'.$count, 'Discount');
      $sheet->setCellValue('G'.$count, 'Delivery Charge');
      $sheet->setCellValue('H'.$count, 'Date Range');
      $sheet->setCellValue('I'.$count, 'Status');
      $count++;

      foreach ($data as $key => $row) {
        $sheet->setCellValue('A'.$count, $row['restaurant']);
        $sheet->setCellValue('B'.$count, $row['total_sales']);
        $sheet->setCellValue('C'.$count, $row['num_of_bills']);
        $sheet->setCellValue('D'.$count, $row['total_amount']);
        $sheet->setCellValue('E'.$count, $row['tax']);
        $sheet->setCellValue('F'.$count, $row['discount']);
        $sheet->setCellValue('G'.$count, $row['delivery_charge']);
        $sheet->setCellValue('H'.$count, $row['date_range']);
        $sheet->setCellValue('I'.$count, $row['status']);
        $count++;
      }   

      $file_name = 'total-sales-'.date('d-m-Y-H-i-s').'.xlsx';
      $file_path = public_path().'/upload/reports/'.$file_name;
      $writer = new Xlsx($spreadsheet);

      ob_start();
      $writer->save("php://output");
      $xlsData = ob_get_contents();
      ob_end_clean();

      $response =  array(
        'op' => 'ok',
        'name' => $file_name,
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData)
      );

      echo json_encode($response);

    } catch(Exception $e) {
        exit($e->getMessage());
    }

  }

  public function topProductListExport(Request $request){

    $qry = DB::table('items')->selectRaw('SUM(orders.total) AS order_total, categories.name AS category_name, products.title AS product_title, users.name AS user_name, users.phone AS user_phone, product_id, SUM(items.price) AS item_total, SUM(items.qty) AS item_qty, orders.name, orders.phone, orders.address, orders.city, orders.state, places.name as restaurantName')
    ->leftJoin('orders', 'orders.id', '=', 'items.order_id')
    ->leftJoin('places', 'places.id', '=', 'orders.place_id')
    ->leftJoin('users', 'users.id', '=', 'items.user_id')
    ->leftJoin('products', 'items.product_id', '=', 'products.id')
    ->leftJoin('categories', 'products.category', '=', 'categories.id')
    ->groupBy('product_id', 'orders.name', 'orders.phone', 'orders.address', 'orders.city', 'orders.state', 'restaurantName', 'user_name', 'user_phone', 'product_title', 'category_name')
    ->orderByDesc('item_qty');

      if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }

    if ($request->orderStatus) {
      $order_status = $request->orderStatus;
      if ($order_status == 2) {
        $qry->where('orders.order_status', 2);
        $status = 'Cancelled';
      } else if ($order_status == 3) {
        $qry->where('orders.order_status', 0);
        $status = 'Complimentary';
      } else if ($order_status == 4) {
        $qry->where('orders.order_status', 1);
        $status = 'Success';
      } else {
        $status = 'All';
      }
    }
    if ($request->orderRestaurants > 0) {
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }

    $result = $qry->get();

    $data = array();
    $i = 1;
    foreach ($result as $row) {     
      $shipping_address = '<small>';
      $shipping_address .= $row->name . '<br>';
      $shipping_address .= $row->phone . '<br>';
      $shipping_address .= $row->address . '<br>';
      $shipping_address .= $row->city . ', ' . $row->state . '<br>';
      $shipping_address .= '</small>';

      $data[] = array(
        "sno" => $i,
        "restaurant" => ucwords($row->restaurantName),  
        'product_title'   => $row->product_title,
        'category' => $row->category_name,
        "qty" => $row->item_qty,    
        "item_total" => '₹' . $row->item_total,
        "user" => $row->user_name,
        "phone" => $row->user_phone,
        "shipping_address" => $shipping_address,
        "order_total" => '₹' . $row->order_total,
      );

      $i++;
    }

    try {
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $count = 1;
      $sheet->setCellValue('A'.$count, 'Restaurant');
      $sheet->setCellValue('B'.$count, 'Product Title');
      $sheet->setCellValue('C'.$count, 'Category');
      $sheet->setCellValue('D'.$count, 'Qty');
      $sheet->setCellValue('E'.$count, 'Items Total');
      $sheet->setCellValue('F'.$count, 'User Name');
      $sheet->setCellValue('G'.$count, 'User phone');
      $sheet->setCellValue('H'.$count, 'Shipping Address');
      $sheet->setCellValue('I'.$count, 'Order Total');
      $count++;

      foreach ($data as $key => $row) {
        $sheet->setCellValue('A'.$count, $row['restaurant']);
        $sheet->setCellValue('B'.$count, $row['product_title']);
        $sheet->setCellValue('C'.$count, $row['category']);
        $sheet->setCellValue('D'.$count, $row['qty']);
        $sheet->setCellValue('E'.$count, $row['item_total']);
        $sheet->setCellValue('F'.$count, $row['user']);
        $sheet->setCellValue('G'.$count, $row['phone']);
        $sheet->setCellValue('H'.$count, $row['shipping_address']);
        $sheet->setCellValue('I'.$count, $row['order_total']);
        $count++;
      }   

      $file_name = 'top-product-'.date('d-m-Y-H-i-s').'.xlsx';
      $file_path = public_path().'/upload/reports/'.$file_name;
      $writer = new Xlsx($spreadsheet);

      ob_start();
      $writer->save("php://output");
      $xlsData = ob_get_contents();
      ob_end_clean();

      $response =  array(
        'op' => 'ok',
        'name' => $file_name,
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData)
      );

      echo json_encode($response);

    } catch(Exception $e) {
        exit($e->getMessage());
    }

  }


  public function averageOrderListExport(Request $request){


    $qry = DB::table('orders')->selectRaw('AVG(orders.total) AS order_avg, COUNT(orders.id) AS orders_count, places.name as restaurantName, SUM(orders.total) AS order_total, SUM(orders.sub_total) AS order_subtotal, AVG(orders.coupon_amount) AS discount_avg')
    ->leftJoin('places', 'places.id', '=', 'orders.place_id')
    ->groupBy('orders.place_id', 'places.name')
    ->orderByDesc('order_avg');
    
     if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      //$qry->whereBetween('order_date', [$from_date, $to_date]);
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      //$qry->whereBetween('order_date', [$from_date, $to_date]);
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }
    if ($request->orderStatus) {
      $order_status = $request->orderStatus;
      if ($order_status == 2) {
        $qry->where('orders.order_status', 2);
        $status = 'Cancelled';
      } else if ($order_status == 3) {
        $qry->where('orders.order_status', 0);
        $status = 'Complimentary';
      } else if ($order_status == 4) {
        $qry->where('orders.order_status', 1);
        $status = 'Success';
      } else {
        $status = 'All';
      }
    }

    if ($request->orderRestaurants > 0) {
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }

    $result = $qry->get();

    $data = array();
    $i = 1;
    
    foreach ($result as $row) {     
      $order_avg = number_format($row->order_avg, 2);
      $tax_total = $row->order_total - $row->order_subtotal;
      $tax_avg = $tax_total / $row->orders_count;
      $tax_avg = number_format($tax_avg, 2);
      $discount_avg = number_format($row->discount_avg, 2);
      $delivery_charge = 0;

      $data[] = array(
        "sno" => $i,
        "restaurant" => ucwords($row->restaurantName),
        "orders_count" => $row->orders_count,
        "order_avg" => '₹' . $order_avg,
        "tax" => '₹' . $tax_avg,
        "discount" => '₹' . $discount_avg,
        "delivery_charge" => '₹' . $delivery_charge
      );

      $i++;
    }

    try {
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $count = 1;
      $sheet->setCellValue('A'.$count, 'Restaurant');
      $sheet->setCellValue('B'.$count, 'Orders Count');
      $sheet->setCellValue('C'.$count, 'Order Avg');
      $sheet->setCellValue('D'.$count, 'Tax');
      $sheet->setCellValue('E'.$count, 'Discount');
      $sheet->setCellValue('F'.$count, 'Delivery Charge');
     
      $count++;

      foreach ($data as $key => $row) {
        $sheet->setCellValue('A'.$count, $row['restaurant']);
        $sheet->setCellValue('B'.$count, $row['orders_count']);
        $sheet->setCellValue('C'.$count, $row['order_avg']);
        $sheet->setCellValue('D'.$count, $row['tax']);
        $sheet->setCellValue('E'.$count, $row['discount']);
        $sheet->setCellValue('F'.$count, $row['delivery_charge']);
       
        $count++;
      }   

      $file_name = 'avg-order-'.date('d-m-Y-H-i-s').'.xlsx';
      $file_path = public_path().'/upload/avg_orders/'.$file_name;
      $writer = new Xlsx($spreadsheet);

      ob_start();
      $writer->save("php://output");
      $xlsData = ob_get_contents();
      ob_end_clean();

      $response =  array(
        'op' => 'ok',
        'name' => $file_name,
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData)
      );

      echo json_encode($response);

    } catch(Exception $e) {
        exit($e->getMessage());
    }

  }

    public function totalRejectedOrderListExport(Request $request){


    $qry = $this->modal::select('orders.*', 'places.name as restaurantName');
    $qry->leftJoin('places', 'places.id', '=', 'orders.place_id')->where('orders.order_status', 2);
    
     

    if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }
    if ($request->orderRestaurants > 0) {
      $totalRecords->where('orders.place_id', '=', $request->orderRestaurants);
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }
   
    $result = $qry->get();
    $reason = '';

    $data = array();
    $i = 1;
    
    foreach ($result as $row) {     
      $shipping_address = '<small>';
      $shipping_address .= $row->name . '<br>';
      $shipping_address .= $row->phone . '<br>';
      $shipping_address .= $row->address . '<br>';
      $shipping_address .= $row->city . ', ' . $row->state . '<br>';
      $shipping_address .= '</small>';
      $tax = $row->total - $row->sub_total;
      $delivery_charge = 0;

      $data[] = array(
        "sno" => $i,
        "order_id" => '#' . $row->id,
        "restaurant" => ucwords($row->restaurantName),
        "user" => $row->User ? $row->User->name : '',
        "phone" => $row->User ? $row->User->phone : '-',
        "shipping_address" => $shipping_address,
        "qty" => $row->qty,
        "sub_total" => '₹' . $row->sub_total,
        "total" => '₹' . $row->total,
        "tax" => '₹' . $tax,
        "discount" => '₹' . $row->coupon_amount,
        "delivery_charge" => '₹' .$delivery_charge,
        "order_date" => $row->order_date,
        "payment_type" => $row->payment_date,
        "reason" => $reason,
        "created_at" => date('Y-m-d h:i A', strtotime($row->created_at)),
      );

      $i++;
    }

    try {
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $count = 1;
      $sheet->setCellValue('A'.$count, 'Order ID');
      $sheet->setCellValue('B'.$count, 'Restaurant');
      $sheet->setCellValue('C'.$count, 'User Name');
      $sheet->setCellValue('D'.$count, 'User Phone');
      $sheet->setCellValue('E'.$count, 'Shipping Address');
      $sheet->setCellValue('F'.$count, 'Qty');
      $sheet->setCellValue('G'.$count, 'Order Subtotal');
      $sheet->setCellValue('H'.$count, 'Order Total');
      $sheet->setCellValue('I'.$count, 'Tax');
      $sheet->setCellValue('J'.$count, 'Discount');
      $sheet->setCellValue('K'.$count, 'Delivery Charge');
      $sheet->setCellValue('L'.$count, 'Order Date');
      $sheet->setCellValue('M'.$count, 'Payment Type');
      $sheet->setCellValue('N'.$count, 'Reason');
     
      $count++;
     
      $count++;

      foreach ($data as $key => $row) {
        $sheet->setCellValue('A'.$count, $row['order_id']);
        $sheet->setCellValue('B'.$count, $row['restaurant']);
        $sheet->setCellValue('C'.$count, $row['user']);
        $sheet->setCellValue('D'.$count, $row['phone']);
        $sheet->setCellValue('E'.$count, $row['shipping_address']);
        $sheet->setCellValue('F'.$count, $row['qty']);
        $sheet->setCellValue('G'.$count, $row['sub_total']);
        $sheet->setCellValue('H'.$count, $row['total']);
        $sheet->setCellValue('I'.$count, $row['tax']);
        $sheet->setCellValue('J'.$count, $row['discount']);
        $sheet->setCellValue('K'.$count, $row['delivery_charge']);
        $sheet->setCellValue('L'.$count, $row['order_date']);
        $sheet->setCellValue('M'.$count, $row['payment_type']);
        $sheet->setCellValue('N'.$count, $row['reason']);
       
        $count++;
      }   

      $file_name = 'rejected-orders-'.date('d-m-Y-H-i-s').'.xlsx';
      $file_path = public_path().'/upload/rejected_orders/'.$file_name;
      $writer = new Xlsx($spreadsheet);

      ob_start();
      $writer->save("php://output");
      $xlsData = ob_get_contents();
      ob_end_clean();

      $response =  array(
        'op' => 'ok',
        'name' => $file_name,
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData)
      );

      echo json_encode($response);

    } catch(Exception $e) {
        exit($e->getMessage());
    }

  }

   public function abandonedOrderListExport(Request $request){

   
    $qry = $this->modal::select('orders.*', 'users.email AS user_email', 'users.name AS user_name', 'users.phone AS user_phone')
    ->leftJoin('users', 'users.id', '=', 'orders.user_id')
    ->where('orders.order_status', 2);

     if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      //$totalRecords->whereBetween('order_date', [$from_date, $to_date]);
      //$qry->whereBetween('order_date', [$from_date, $to_date]);
     
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }
    if ($request->orderRestaurants > 0) {
      //$totalRecords->where('orders.place_id', '=', $request->orderRestaurants);
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }
    
      $result = $qry->get();

    $data = array();
    $i = 1;
    
    foreach ($result as $row) {     
       if ($row->pay_status == '1') {
        $pay_status = 'Complete';
      } elseif ($row->pay_status == '2') {
        $pay_status = 'Cancelled';
      } else {
        $pay_status = 'Pending';
      }

      $data[] = array(
        "sno" => $i,
        "user" => $row->user_name,
        "phone" => $row->user_phone,
        "email" => $row->user_email,
        "pay_status" => $pay_status,
      );

      $i++;
    }

    try {
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $count = 1;
      $sheet->setCellValue('A'.$count, 'User');
      $sheet->setCellValue('B'.$count, 'Phone');
      $sheet->setCellValue('C'.$count, 'Email');
      $sheet->setCellValue('D'.$count, 'Pay Status');
     
     
      $count++;
     
      $count++;

      foreach ($data as $key => $row) {
        $sheet->setCellValue('A'.$count, $row['user']);
        $sheet->setCellValue('B'.$count, $row['phone']);
        $sheet->setCellValue('C'.$count, $row['email']);
        $sheet->setCellValue('D'.$count, $row['pay_status']);

       
        $count++;
      }   

      $file_name = 'abandoned-orders-'.date('d-m-Y-H-i-s').'.xlsx';
      $file_path = public_path().'/upload/abandoned_orders/'.$file_name;
      $writer = new Xlsx($spreadsheet);

      ob_start();
      $writer->save("php://output");
      $xlsData = ob_get_contents();
      ob_end_clean();

      $response =  array(
        'op' => 'ok',
        'name' => $file_name,
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData)
      );

      echo json_encode($response);

    } catch(Exception $e) {
        exit($e->getMessage());
    }

  }   

  public function repeatCustomerListExport(Request $request){

   
    $qry = DB::table('orders')->selectRaw('places.name as restaurantName, COUNT(orders.id) AS orders_count, users.name AS user_name, users.phone AS user_phone,  users.email AS user_email, SUM(orders.total) AS order_total, SUM(orders.sub_total) AS order_subtotal, SUM(orders.total_pay) AS amount_pay, SUM(orders.sub_total) AS order_subtotal')
    ->leftJoin('places', 'places.id', '=', 'orders.place_id')
    ->leftJoin('users', 'users.id', '=', 'orders.user_id')
    ->groupBy('orders.user_id', 'users.name', 'users.phone', 'users.email', 'places.name')
    ->orderByDesc('orders_count');
    $status = 'All';

     if ($request->customDate) {
      $date_arr = explode(' - ', $request->customDate);
      $from_date = date('Y-m-d', strtotime($date_arr[0]));
      $to_date = date('Y-m-d', strtotime($date_arr[1]));
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }else{
      $from_date = date('Y-m-d');
      $to_date = date('Y-m-d');
      $qry->where('order_date', '<=', "$to_date")->where('order_date', '>=', "$from_date");
    }
    if ($request->orderRestaurants > 0) {
      //$totalRecords->where('orders.place_id', '=', $request->orderRestaurants);
      $qry->where('orders.place_id', '=', $request->orderRestaurants);
    }
    if ($request->orderStatus) {

      $order_status = $request->orderStatus;
      if ($order_status == 2) {
        $totalRecords->where('orders.order_status', 2);
        $qry->where('orders.order_status', 2);
        $status = 'Cancelled';
      } else if ($order_status == 3) {
        $totalRecords->where('orders.order_status', 0);
        $qry->where('orders.order_status', 0);
        $status = 'Complimentary';
      } else if ($order_status == 4) {
        $totalRecords->where('orders.order_status', 1);
        $qry->where('orders.order_status', 1);
        $status = 'Success';
      } else {
        $status = 'All';
      }
    }
    
      $result = $qry->get();

    $data = array();
    $i = 1;
    
    foreach ($result as $row) {     
       if ($row->pay_status == '1') {
        $pay_status = 'Complete';
      } elseif ($row->pay_status == '2') {
        $pay_status = 'Cancelled';
      } else {
        $pay_status = 'Pending';
      }

      $data[] = array(
        "sno" => $i,
        "restaurant" => ucwords($row->restaurantName),
        "qty" => $row->orders_count,
        "user" => $row->user_name,
        "phone" => $row->user_phone,
        "email" => $row->user_email,
        "amount_pay" => '₹' . $row->amount_pay,
        "total" => '₹' . $row->order_total,
        "delivery_charge" => '₹' . $row->order_total,
        "discount" => '₹' . $row->order_total,
        "tax" => $total_tax,
        "payment_date" => $delivery_charge,
        "status" => $status,
      );

      $i++;
    }

    try {
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $count = 1;
      $sheet->setCellValue('A'.$count, 'Restaurant name');
      $sheet->setCellValue('B'.$count, 'Qty');
      $sheet->setCellValue('C'.$count, 'User');
      $sheet->setCellValue('D'.$count, 'Phone');
      $sheet->setCellValue('E'.$count, 'Email');
      $sheet->setCellValue('F'.$count, 'Amount');
      $sheet->setCellValue('G'.$count, 'Order Total');
      $sheet->setCellValue('H'.$count, 'Delivery Charge');
      $sheet->setCellValue('I'.$count, 'Discount');
      $sheet->setCellValue('J'.$count, 'Tax');
      $sheet->setCellValue('K'.$count, 'Payment Date');
  
      $count++;

      foreach ($data as $key => $row) {
        $sheet->setCellValue('A'.$count, $row['restaurant']);
        $sheet->setCellValue('B'.$count, $row['qty']);
        $sheet->setCellValue('C'.$count, $row['user']);
        $sheet->setCellValue('D'.$count, $row['phone']);
        $sheet->setCellValue('E'.$count, $row['email']);
        $sheet->setCellValue('F'.$count, $row['amount_pay']);
        $sheet->setCellValue('G'.$count, $row['total']);
        $sheet->setCellValue('H'.$count, $row['delivery_charge']);
        $sheet->setCellValue('I'.$count, $row['discount']);
        $sheet->setCellValue('J'.$count, $row['tax']);
        $sheet->setCellValue('K'.$count, $row['payment_date']);

        $count++;
      }   

      $file_name = 'repeat-customer-'.date('d-m-Y-H-i-s').'.xlsx';
      $file_path = public_path().'/upload/repeat_customers/'.$file_name;
      $writer = new Xlsx($spreadsheet);

      ob_start();
      $writer->save("php://output");
      $xlsData = ob_get_contents();
      ob_end_clean();

      $response =  array(
        'op' => 'ok',
        'name' => $file_name,
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData)
      );

      echo json_encode($response);

    } catch(Exception $e) {
        exit($e->getMessage());
    }

  }


  public function findKeyMultiple($array, $keySearch, $value)
  {
      foreach ($array as $key => $item) {
        foreach ($item as $k => $v) {
         /* echo '<br>';
          echo $item[$keySearch];
          echo '<br>';
          echo $value;
          echo '<br>';*/
          /*echo 'keySearch = '.$keySearch; echo '<br>';
          echo 'value = '.$value; echo '<br>';*/

          if ($k = $keySearch && $v == $value)
          {
          //if ($item[$keySearch] == $value) {
              return $key;
          } 
        }
      }
      return -1;
  }
  
}
