<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Item;
use App\Models\Refund;
use App\Models\Place;
use App\Models\User;
use Razorpay\Api\Api;
use Validator;
use Auth;
use Illuminate\Support\Facades\Hash;

class OrdersController extends Controller
{
  protected $page;
  protected $module;
  protected $modal;
  protected $route;
  protected $refund_module;
  protected $refund_orders;
  protected $refund_orders_list;


  public function __construct()
  {
    $this->page = new \stdClass;
    $this->modal = 'App\Models\Order';
    $this->route = new \stdClass;
    $this->module = 'Order';
    $this->route->list = route('restaurant.r_orders.list');
    $this->route->show = route("r_orders.show", ":id");
    $this->route->orderStatus = route("admin.orders.orderStatus", ":id");
    $this->route->changeStatus = route("restaurant.orders.changeStatus");
    $this->route->changeItemStatus = route("restaurant.orders.changeItemStatus");
    $this->route->refund_orders = route("restaurant.refund_orders");
   // $this->route->refund_orders_list = route("restaurant.refund_orders_list");
    $this->refund_module = 'Refund';
  }

  public function index()
  {
    //echo $this->route->add;die;
    $this->page->title = $this->module . 's List';
    return view('restaurant.' . $this->module . '.index', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module]);
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


    $totalRecords = $this->modal::where('place_id', Auth::user()->id)->count();

    $totalRecordwithFilter = $totalRecords;

    $qry = $this->modal::where('place_id', Auth::user()->id)->offset($row)->take($rowperpage);
    $qry->orderby('orders.id', 'desc');

      

    if($searchValue){
      $qry->where(function ($query) use($searchValue) {
          $query->where('orders.name', 'like', '%' . $searchValue . '%')
          ->orWhere('orders.phone', 'like', '%' . $searchValue . '%')
          ->orWhere('orders.city', 'like', '%' . $searchValue . '%')
          ->orWhere('orders.address', 'like', '%' . $searchValue . '%')
          ->orWhere('orders.qty', 'like', '%' . $searchValue . '%')
          ->orWhere('orders.total', 'like', '%' . $searchValue . '%')
          ->orWhere('orders.state', 'like', '%' . $searchValue . '%');
        
      });
   }
    /*$qry = $this->modal::offset($row)->take($rowperpage);
        $qry->select('orders.*','places.name as restaurantName');
        $qry->leftJoin('places','places.id','=','orders.place_id');*/



    $result = $qry->get();

    $data = array();
    $i = 1;
    foreach ($result as $row) {
      if ($row->status == '1') {
        $status = 'Complete';
      } else {
        $status = 'Not Complete';
      }

      $order_status = $order_for = '';
      $changeStatus =  $this->route->changeStatus;

      /*$order_status = $row;
            print_r($row->order_status);die;*/

             
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

      $action = '';
      $show_url = $this->route->show;
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

  public function show($id)
  {
    $info = $this->modal::find($id);
    $items = array();
    $p = Item::select('items.*');
    $p->where('items.order_id', $id);
    $items = $p->get()->toArray();
    $i = 0;
    foreach ($items as $item) {
      $product = Product::where(['id' => $item['product_id']]);
      $product_arr = $product->get()->toArray();
      if (count($product_arr) > 0) {
        $items_arr[$i] = $item;
        $items_arr[$i]['product'] = getProductDetail($item['product_id']);
        $i++;
      }
    }

    // echo '<pre>';print_r($items);die;        
    return view('restaurant.' . $this->module . '.show', [
      'info' => $info,
      'items' => $items_arr,
      'route' => $this->route,
      'module' => $this->module
    ]);
  }

  public function changeStatus(Request $request)
  {

    $id = $request->order_id;
    $order_status = $request->status;

    if ($id) {
      $validator = Validator::make(
        $request->all(),
        [
          'status'       => 'required',
          'order_id'     => 'required',
        ]
      );

      if ($validator->fails()) {
        return $validator->validate();
      } else {
        $obj = $this->modal::firstOrNew(['id' => $id]);
        $obj->order_status = $order_status;
        $obj->status = 1;
        $payment_id = $obj->payment_id;
        $order_total_actual = $obj->total_pay;
        $order_total = $order_total_actual * 100; //($order_total_actual - (($order_total_actual * 2) / 100)) * 100;

        /*var_dump($order_total);
                die;*/

        $user_id = $obj->user_id;
        $updated_by = Auth::user()->id;
        $obj->save();

        $check_order = Order::where(['id' => $request->order_id])->first();



        $place_data = Place::where('id',$check_order->place_id)->first();	
        $user_data = User::where('id',$check_order->user_id)->first();
        // echo"<pre>";print_r($check_order->user_id);die;
        $phone = $user_data->phone;  
        $place_name = $place_data->name;

        sendNotification('Order Status','Your Order has Accepted By Restaurant '.$place_name.'','','user_'.$phone.'');

        if ($order_status == "2") {
       sendNotification('Order Status','Your Order has Decline By Restaurant '.$place_name.'','','user_'.$phone.'');

          /*var_dump(base64_encode(env('RAZORPAY_KEY').":".env('RAZORPAY_SECRET')));
                    die;*/

          //$payment_id = "pay_Ipax18fGeeI67y";
          $post_arr = array(
            "amount" => $order_total,
            "speed" => "optimum"
          );
          $post_json = json_encode($post_arr);

          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.razorpay.com/v1/payments/" . $payment_id . "/refund",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_json,
            CURLOPT_HTTPHEADER => array(
              "cache-control: no-cache",
              "postman-token: bc62ba6a-2bb4-eeed-7b4c-6580c0bcaf13",
              'Content-Type:application/json',
              'Authorization: Basic ' . base64_encode(env('RAZORPAY_KEY') . ":" . env('RAZORPAY_SECRET'))
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
            //echo "cURL Error #:" . $err;
            $res_status = 'Curl error';
            $res_code = 201;
            $status = 'error';
          } else {
            //echo $response;

            $response_arr = json_decode($response, true);
            if (array_key_exists('error', $response_arr)) {
              $res_status = $response_arr['error']['description'];
              $res_code = 202;
              $status = 'error';
            } else {
              $res_status = $response_arr['status'];
              $res_code = 200;
              $status = 'success';
            }
          }

          $refund = Refund::firstOrNew(
            [
              'order_id' => $id,
              'payment_id' => $payment_id,
              'total_amount' => 0,
              'refund_amount' => $order_total_actual,
              'status' => $status,
              'comment' => $res_status,
              'user_id' => $user_id,
              'updated_by' => $updated_by,
              'created_at' => date('d-m-Y H:i:s', time()),
              'updated_at' => date('d-m-Y H:i:s', time())
            ]
          );
          $refund->save();
        }

        return response()->json(['success' => 1, 'message' => $this->module . ' status updated successfully.']);
      }
    }
  }

  public function changeItemStatus(Request $request)
  {
    $id = $request->item_id;
    if ($id) {
      $validator = Validator::make(
        $request->all(),
        [
          'status'       => 'required',
          'item_id'     => 'required',
        ]
      );

      if ($validator->fails()) {
        return $validator->validate();
      } else {
        
        $obj = Item::firstOrNew(['id' => $request->item_id]);
        $obj->is_cancelled = $request->status;
        $obj->save();

        $order_id = $obj->order_id;

        $item_obj = Item::where(['order_id' => $order_id, 'is_cancelled' => 0])->get()->toArray();
        $order_obj = $this->modal::firstOrNew(['id' => $order_id]);
        $payment_id = $order_obj->payment_id;
        $order_total_actual = $order_obj->total_pay;

        $user_id = $obj->user_id;
        $updated_by = Auth::user()->id;

        $item_qty = $obj->qty;       
        $item_total =  $obj->sub_total; 
      
        $item_price_actual = $item_total;
        $product_id = $obj->product_id;
        $remaining_total = $order_total_actual - $item_price_actual;

        if ($remaining_total >= 0) {             
          $item_price = (int)$item_price_actual * 100;
          if ($payment_id) {
            $post_arr = array(
              "amount" => $item_price,
              "speed" => "optimum"
            );
            $post_json = json_encode($post_arr);

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.razorpay.com/v1/payments/" . $payment_id . "/refund",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $post_json,
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: bc62ba6a-2bb4-eeed-7b4c-6580c0bcaf13",
                'Content-Type:application/json',
                'Authorization: Basic ' . base64_encode(env('RAZORPAY_KEY') . ":" . env('RAZORPAY_SECRET'))
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              //echo "cURL Error #:" . $err;
              $res_status = 'Curl error';
              $res_code = 201;
              $status = 'error';
            } else {
              //echo $response;

              $response_arr = json_decode($response, true);
              if (array_key_exists('error', $response_arr)) {
                $res_status = $response_arr['error']['description'];
                $res_code = 202;
                $status = 'error';
              } else {
                $res_status = $response_arr['status'];
                $res_code = 200;
                $status = 'success';
              }
            }

            $refund = Refund::firstOrNew(
              [
                'order_id' => $order_id,
                'payment_id' => $payment_id,
                'total_amount' => $remaining_total,
                'refund_amount' => $item_price_actual,
                'status' => $status,
                'comment' => $res_status,
                'product_id' => $product_id,
                'user_id' => $user_id,
                'updated_by' => $updated_by,
                'created_at' => date('d-m-Y H:i:s', time()),
                'updated_at' => date('d-m-Y H:i:s', time())
              ]
            );
            $refund->save();
          }
        } elseif ($order_total_actual > 0 && $remaining_total < 0) {        
          $remaining_total = 0;
          $item_price_actual = $order_total_actual;
          $item_price = (int)$item_price_actual * 100;

          if ($payment_id) {
            $post_arr = array(
              "amount" => $item_price,
              "speed" => "optimum"
            );
            $post_json = json_encode($post_arr);

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.razorpay.com/v1/payments/" . $payment_id . "/refund",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $post_json,
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: bc62ba6a-2bb4-eeed-7b4c-6580c0bcaf13",
                'Content-Type:application/json',
                'Authorization: Basic ' . base64_encode(env('RAZORPAY_KEY') . ":" . env('RAZORPAY_SECRET'))
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              //echo "cURL Error #:" . $err;
              $res_status = 'Curl error';
              $res_code = 201;
              $status = 'error';
            } else {
              //echo $response;

              $response_arr = json_decode($response, true);
              if (array_key_exists('error', $response_arr)) {
                $res_status = $response_arr['error']['description'];
                $res_code = 202;
                $status = 'error';
              } else {
                $res_status = $response_arr['status'];
                $res_code = 200;
                $status = 'success';
              }
            }

            $refund = Refund::firstOrNew(
              [
                'order_id' => $order_id,
                'payment_id' => $payment_id,
                'total_amount' => $remaining_total,
                'refund_amount' => $item_price_actual,
                'status' => $status,
                'comment' => $res_status,
                'product_id' => $product_id,
                'user_id' => $user_id,
                'updated_by' => $updated_by,
                'created_at' => date('d-m-Y H:i:s', time()),
                'updated_at' => date('d-m-Y H:i:s', time())
              ]
            );
            $refund->save();
          }
        } elseif ($order_total_actual < 0) {          
          $remaining_total = 0;
          $item_price_actual = 0;
          $item_price = $item_price_actual * 100;
        }

        $order_obj->total_pay = $remaining_total;

        if (is_array($item_obj) && empty($item_obj)) {
          $order_obj->order_status = 2;
        }
        $order_obj->save();

        return response()->json(['success' => 1, 'message' => $this->module . ' item cancelled successfully.']);
      }
    }
  }

  public function refund_orders()
  { 
    //echo $this->route->add;die;
    $this->page->title = $this->refund_module . 's List';
    return view('restaurant.' . $this->refund_module . '.index', ['page' => $this->page, 'route' => $this->route, 'module' => $this->refund_module]);
  }

  public function refund_orders_list(Request $request)
  {
    
    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    $totalRecords = Refund::select('refunds.*')->where('orders.place_id', Auth::user()->id)->leftJoin('orders','refunds.order_id','=','orders.id')->count();
    $totalRecordwithFilter = $totalRecords;

    $qry = Refund::where('orders.place_id', Auth::user()->id)->leftJoin('orders','refunds.order_id','=','orders.id')->offset($row)->take($rowperpage);
    $qry->select('refunds.*');
    $qry->orderby('refunds.id', 'desc');

    if($searchValue){
      $qry->where(function ($query) use($searchValue) {
          $query->where('total_amount', 'like', '%' . $searchValue . '%')
          ->orWhere('refund_amount', 'like', '%' . $searchValue . '%')
          ->orWhere('product_id', 'like', '%' . $searchValue . '%')
          ->orWhere('comment', 'like', '%' . $searchValue . '%')
          ->orWhere('orders.status', 'like', '%' . $searchValue . '%');

        
      });
   }

     $result = $qry->get();



    $data = array();
    $i = 1;
    foreach ($result as $row) {

      $updated_by_obj = Auth::User(['id' => $row->updated_by]);
      $refund_by = $updated_by_obj->name;

      $data[] = array(
        "sno" => $i,
        "order_id" => '#' . $row->order_id,
        "payment_id" => $row->payment_id,
        "total_amount" => '₹' . $row->total_amount,
        "refund_amount" => '₹' . $row->refund_amount,
        "product_id" => $row->product_id,
        "status" => ucfirst($row->status),
        "refund_details" => $row->comment,
        "user_id" => $row->User ? $row->User->name : '',
        "refund_by" => $refund_by,
        "created_at" => date('Y-m-d h:i A', strtotime($row->created_at)),
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
