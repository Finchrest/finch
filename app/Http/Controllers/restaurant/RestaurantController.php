<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

use App\Models\Product;
use App\Models\PassportOrder;
use App\Models\PassportFreeItem;
use App\Models\GeneralSetting;
use App\Models\Item;
use App\Models\Refund;
use App\Models\Home_address;
// use App\Models\List;
use Auth;
use DB;
use Cart;
use Softon\Indipay\Facades\Indipay;


class RestaurantController extends Controller
{
  protected $page;

  public function __construct()
  {
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
    $totalRecords = $this->modal::where(['order_date' => $date, 'place_id' => Auth::user()->id])->count();
    $sound = GeneralSetting::select('general_settings.*', 'upload_images.file as sound')->where('general_settings.id', 7)->leftJoin('upload_images', 'upload_images.id', '=', 'general_settings.meta_value')->first();
    $Audio = $sound->sound;


    $date = date('Y-m-d');
    $getOrders = $this->modal::select('orders.*', 'items.product_id', 'locations.name as location_name', 'places.name as place_name')->where(['order_date' => $date, 'orders.status' => 1, 'orders.order_status' => 0, 'orders.place_id' => Auth::user()->id])->leftJoin('locations', 'locations.id', '=', 'orders.location')->leftJoin('places', 'places.id', '=', 'orders.place_id')->leftJoin('items', 'items.order_id', '=', 'orders.id')->groupBy('items.order_id')->get();



    return view('restaurant.dashboard', ['page' => $this->page, 'sound' => $Audio, 'getOrders' => $getOrders, 'totalRecords' => $totalRecords]);
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

    $totalRecords = $this->modal::where(['order_date' => $date, 'orders.status' => 1, 'place_id' => Auth::user()->id])->count();

    $totalRecordwithFilter = $totalRecords;

    //   echo"<pre>";print_r( $date);die;
    $qry = $this->modal::offset($row)->take($rowperpage);
    $qry->select('orders.*', 'places.name as restaurantName');
    $qry->where(['order_date' => $date, 'orders.status' => 1, 'place_id' => Auth::user()->id]);
    $qry->leftJoin('places', 'places.id', '=', 'orders.place_id');
    $qry->orderby('orders.id', 'desc');


    if ($searchValue) {
      $qry->where(function ($query) use ($searchValue) {
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
    $totalRecords = $this->modal::where(['order_date' => $date, 'orders.status' => 1, 'orders.order_status' => 0, 'place_id' => Auth::user()->id])->count();

    // echo"<pre>";print_r($totalRecords);die;
    return response()->json(['success' => 1, 'message' => 'New Order', 'totalOrder' => $totalRecords]);
  }


  public function getDashboredOrders()
  {
    // echo '<pre>'; print_r(Auth::user()->id);die;
    $date = date('Y-m-d');
    $getOrders = $this->modal::select('orders.*', 'items.product_id', 'locations.name as location_name', 'places.name as place_name', 'products.title as product_name', 'categories.name as cat_name', 'upload_images.file as image')->where(['order_date' => $date, 'orders.status' => 1, 'orders.order_status' => 0, 'place_id' => Auth::user()->id])->leftJoin('locations', 'locations.id', '=', 'orders.location')->leftJoin('places', 'places.id', '=', 'orders.place_id')->leftJoin('items', 'items.order_id', '=', 'orders.id')->groupBy('items.order_id')->leftJoin('products', 'products.id', '=', 'items.product_id')->leftJoin('categories', 'categories.id', '=', 'products.category')->leftJoin('upload_images', 'upload_images.id', '=', 'products.file_id')->groupBy('items.order_id')->get();
    //  echo '<pre>'; print_r($getOrders->toArray());die;
    $view = view('restaurant.resatuarantorders', ['orders' => $getOrders])->render();


    return response()->json(['success' => 1, 'message' => 'New Order', 'view' => $view, 'ordercount' => count($getOrders)]);
  }

  public function addOrder()
  {

    $this->page->title = 'Add Order';
    return view('restaurant.add_order_view', ['page' => $this->page]);
  }


  public function passportCodeUser(Request $request)
  {

    $passport = PassportOrder::select('passport_orders.*', 'passports.name as passName')->where('passport_code', $request->passport_code)->join('passports', 'passports.id', '=', 'passport_orders.passport_id')->first();

    if (empty($passport)) {
      return response()->json(['status' => 0, 'message' => 'Invalid Password code']);
    } else {
      $view = view('restaurant.user_passort_view', compact('passport'))->render();
      return response()->json(['status' => 1, 'message' => 'New Order', 'view' => $view]);
    }
  }

  public function getPassportItem(Request $request)
  {

    $passport_id = $request->id;
    $passport_data = PassportOrder::where('passport_id', $passport_id)->first();
    $passportCode = $request->passportCode;
    $products = Product::where('for_passport', 1)->where('status', 1)->get();

    $view = view('restaurant.passport_item_add', compact('passport_data', 'products', 'passportCode'))->render();
    return response()->json(['success' => 1, 'message' => 'New Order', 'view' => $view]);
  }


  public function orderSave(Request $request)
  {


    $passport_id = $request->passport_id;
    $quantity = $request->quantitiy;
    $passport_code = $request->passport_code;
    $pid = $request->products;
    $products = Product::where('id', $pid)->first();
    $passport_data = PassportOrder::where('passport_id', $passport_id)->first();
    $view = view('restaurant.user_product_view', compact('products', 'passport_id', 'quantity', 'passport_code'))->render();
    return response()->json(['success' => 1, 'message' => 'Product added in cart', 'view' => $view]);
  }

  public function orderFreeSave(Request $request)
  {

    // echo "<pre>";print_r($request->all());die;
    $passport_id = $request->passport_id;
    $quantity = 1;
    $passport_code = $request->passport_code;

    $pid = $request->products;

    $passport_data = PassportOrder::where('passport_code', $passport_code)->first();
    $products = PassportFreeItem::select('products.*')->where('passport_id', $passport_data->passport_id)->where('product_id', $request->products)->join('products', 'products.id', '=', 'passport_free_item.product_id')->first();


    $view = view('restaurant.user_product_free_view', compact('products', 'passport_id', 'quantity', 'passport_code'))->render();
    return response()->json(['success' => 1, 'message' => 'Product added in cart', 'view' => $view]);
  }

  public function getFreeItem(Request $request)
  {


    $passportCode = $request->passportCode;
    $passport_data = PassportOrder::where('passport_code', $passportCode)->first();
    $freePassportId = explode(',', $passport_data->is_free);


    $products = PassportFreeItem::select('products.*')->where('passport_id', $passport_data->passport_id)->whereNotIn('products.id', $freePassportId)->join('products', 'products.id', '=', 'passport_free_item.product_id')->get();



    $view = view('restaurant.passport_free_item_add', compact('passport_data', 'products', 'passportCode'))->render();
    return response()->json(['success' => 1, 'message' => 'New Order', 'view' => $view]);
  }

  public function saveProductOrder(Request $request)
  {

    $product = Product::find($request->id);
    $passport = PassportOrder::select('passport_orders.*', 'passports.name as passName')->where('passport_orders.passport_code', $request->passport_code)->join('passports', 'passports.id', '=', 'passport_orders.passport_id')->first();

    $freeProduct = array($passport->is_free);
    if (!isset($request->id[1])) {
      $requestArray = array($request->id);
    } else {
      $requestArray = array($request->id[1]);
    }
    if (empty($passport->is_free)) {

      $isFreeProduct = $request->id[1];
    } else {
      $fProduct =  array_merge($freeProduct, $requestArray);
      @$isFreeProduct = implode(',', $fProduct);
    }
    $order_data = array(
      'is_free' => $isFreeProduct,
    );

    PassportOrder::where(['passport_code' => $request->passport_code])->update($order_data);

    $homeAddress = Home_address::select('*')->where('user_id', $passport->user_id)->first();

    $PriceArray = $request->price[0] * $request->quantities[0];
    @$PriceArray2 = $request->price[1] * $request->quantities[1];
    $finalPrice = $PriceArray + $PriceArray2;

    $TotalPriceArray = $request->total_price[0] * $request->quantities[0];
    @$TotalPriceArray2 = $request->total_price[1] * $request->quantities[1];
    $TotalfinalPrice = $TotalPriceArray + $TotalPriceArray2;

    $totalQuantity = array_sum($request->quantities);



    $order = Order::create([
      'user_id' => $passport->user_id,
      'place_id' => Auth::user()->id,
      'location' => Auth::user()->location,
      'name' => $passport->name,
      'phone' => $passport->phone,
      'address' => $homeAddress->title ?? '',
      'state' => $homeAddress->state ?? '',
      'city' => $homeAddress->city ?? '',
      'pincode' => $homeAddress->pincode ?? '',
      'order_for' => 0,
      'qty' => $totalQuantity,
      'sub_total' => $finalPrice,
      'total' => $TotalfinalPrice,
      'total_pay' => 'Paid',
      'type' => 0,
      'status' => 0,
      'order_status' => 0,
      'order_date' => date('Y-m-d'),
      'is_restaurant' => 1,
    ]);


    foreach ($request->id as $key => $con) {

      $orderItem =  Item::create([
        'user_id' => Auth::user()->id,
        'order_id' => $order->id,
        'product_id' => $request->id[$key],
        'qty' =>   $request->quantities[$key],
        'price' => $request->price[$key],
        'sub_total' =>  $request->total_price[$key],
        'attr_id' => 0,
        'option_id' => 0,
      ]);
    }







    return response()->json(['success' => 1, 'message' => ' Order created successfully.']);
  }
}
