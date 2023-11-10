<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PassportOrder;
use App\Models\Product;
use App\Models\Item;
use App\Models\Refund;
use Razorpay\Api\Api;
use Validator;
use Auth;
use Illuminate\Support\Facades\Hash;

class PassportConfirm extends Controller
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
    $this->modal = 'App\Models\PassportOrder';
    $this->route = new \stdClass;
    $this->module = 'passport_confirm';


    $this->refund_module = 'Refund';
    //$this->auth_modal = 'App\Models\Auth';
  }

  public function index()
  {

    //echo $this->route->add;die;
    $this->page->title = $this->module . 's List';
    return view('superadmin.' . $this->module . '.index', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module]);
  }


  public function list(Request $request)
  {

    ## Read value
    // echo"<pre>";print_r( $request->toArray());die;
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value


    $totalRecords = $this->modal::all()->count();

    $totalRecordwithFilter = $totalRecords;

    $qry = $this->modal::offset($row)->take($rowperpage);
    $qry->select('*')->orderBy('id', 'DESC');

    // if ($searchValue) {
    //   $qry->where(function ($query) use ($searchValue) {
    //     $query->where('passport_orders.name', 'like', '%' . $searchValue . '%');
    //   });
    // }

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
      $action = '';
      // $show_url = data;
      // $orderStatus = {{ route('admin.passport_confirm.list') }};
      // $changeStatus =  $this->route->changeStatus;

      if ($row->order_for == 1) {
        $order_for = 'Dine-In Order';
      } else {
        $order_for = 'Delivery Order';
      }


      if ($row->is_approw == '1') {
        $order_status = 'Accepted';
      } elseif ($row->is_approw == '2') {
        $order_status = 'Declined';
      } else {
        $order_status .= '<a href="javascript:void(0)" class="btn btn-success btn-sm" onclick=update_status(' . $row->id . ',1);>Accept</a>  <a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick=update_status(' . $row->id . ',2);>Decline</a>';
      }



      $shipping_address = '<small>';

      $shipping_address .= $row->phone . '<br>';
      $shipping_address .= $row->address . '<br>';
      $shipping_address .= $row->city . ', ' . $row->state . '<br>';
      $shipping_address .= '</small>';


      $data[] = array(
        "sno" => $i,
        "order_id" => '#' . $row->id,
        "name" =>  $row->name,
        "phone" =>  $row->phone,
        "email" => $row->email,
        "price" => $row->price,
        "action" => $order_status,
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
    $p = Item::where('items.order_id', $id);
    $items = $p->get()->toArray();
    $i = 0;
    $items_arr = array();
    foreach ($items as $item) {
      $product = Product::where(['id' => $item['product_id']]);
      $product_arr = $product->get()->toArray();
      if (count($product_arr) > 0) {
        $items_arr[$i] = $item;
        $items_arr[$i]['product'] = getProductDetail($item['product_id']);
        $i++;
      }
    }

    //echo '<pre>';print_r($items);die;        
    return view('superadmin.' . $this->module . '.show', [
      'info' => $info,
      'items' => $items_arr,
      'route' => $this->route,
      'module' => $this->module
    ]);
  }

  public function orderStatus($id)
  {
    $info = $this->modal::find($id);
    return view('superadmin.' . $this->module . '.orderStatus', [
      'info' => $info,
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
        $obj = $this->modal::firstOrNew(['id' => $request->order_id]);
        $obj->is_approw = $order_status;
        $obj->save();
      }



      return response()->json(['success' => 1, 'message' => $this->module . ' status updated successfully.']);
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
    return view('superadmin.' . $this->refund_module . '.index', ['page' => $this->page, 'route' => $this->route, 'module' => $this->refund_module]);
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


    $totalRecords = Refund::all()->count();

    $totalRecordwithFilter = $totalRecords;

    $qry = Refund::offset($row)->take($rowperpage);
    $qry->select('*');
    $qry->orderby('id', 'desc');

    if ($searchValue) {
      $qry->where(function ($query) use ($searchValue) {
        $query->where('total_amount', 'like', '%' . $searchValue . '%')
          ->orWhere('refund_amount', 'like', '%' . $searchValue . '%')
          ->orWhere('product_id', 'like', '%' . $searchValue . '%')
          ->orWhere('comment', 'like', '%' . $searchValue . '%')
          ->orWhere('status', 'like', '%' . $searchValue . '%');
      });
    }
    //$qry->leftJoin('places','places.id','=','orders.place_id');
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
