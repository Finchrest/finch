<?php

namespace App\Http\Controllers;


use App\Models\Banner;
use App\Models\Place;
use App\Models\Product;
use App\Models\Location;
use App\Models\PassportPage;
use App\Models\Passport;
use App\Models\PassportOrder;
use App\Models\PassportOrderHistory;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Razorpay\Api\Api;
use Session;
use Exception;
use Cart;

class FrontPassportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $auth_id= '';
        if(isset(auth()->user()->id)){
        $auth_id = auth()->user()->id;
        }
        $passports = Passport::select('passports.*')->get();
        return view('front/passport/index',compact('passports','auth_id'));
    }

    public function showPassportPage()
    {
        $getLocation = session('location');
        if ($getLocation) {
            $p = Passport::select('passports.*')->where('location', $getLocation)->get();
            if (count($p) > 1) {
                $data['passport_mutli'] =  $p;
                //  echo '<pre>user - '; print_r($p->toArray()); die;
            } else {
                $p_new = Passport::select('passports.*')->where('location', $getLocation)->first();
                $data['passport_one'] =  $p_new;
            }
            if (!empty(auth()->user()->id)) {
                $view = view('front/passport/passport_view', $data);
                return response()->json(['success' => 1, 'view' => $view->render()]);
            } else {
                return response()->json(['success' => 0, 'message' => 'Please login first!!']);
            }
        } else {
            return response()->json(['success' => 0, 'message' => 'Please Select location To Purchase passport!!']);
        }
    }

    public function getPassportView(Request $request)
    {
        $getLocation = session('location');
        $p = Passport::select('id', 'passport_id', 'name', 'sub_description', 'description', 'file_id', 'sub_total', 'tax', 'price')->where('id', $request->id);
        $user = User::where('id', auth()->user()->id)->first();
        if ($getLocation) {
            $p->where('location', $getLocation);
        }
        $p->orderBy('id', 'DESC');
        $pass = $p->first();
        if ($pass) {
            $pass->image = asset($pass->FileId->file);
            $data['passport'] = $pass;
            $data['user'] = $user;
            $view = view('front/passport/get_passport_view', $data);
            return response()->json(['success' => 1, 'view' => $view->render()]);
        } else {
            return response()->json(['success' => 0, 'message' => 'Passport not available on selected location.']);
        }
    }

    public function getPassportConfirmView(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all());// die;
        $p = PassportOrder::where('id', $request->id);
        $pass = $p->first();
        $data['passportConfirmOrder'] = $pass;
        $view = view('front/passport/passport_confirm_view', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }

    public function getPassportSummaryView(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all());// die;
        $p = PassportOrder::where('id', $request->id);
        $data['passportOrder'] = $pass = $p->first();
        $view = view('front/passport/passport_summary_view', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }

    public function passportOrderSubmit(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all()); die;
        $validator = Validator::make($request->all(), [
            'consumer_name' => 'required',
            'phone' => 'required|digits:10|',
            'email' => 'required',
            // 'price'=>'required',
        ]);
        if ($validator->fails()) {
            return $validator->validate();
        }

        $passport_id = $request->id;
        $passport = Passport::where('id', $passport_id)->first();
        if (!$passport) {
            return response()->json(['success' => 0, 'message' => 'Invalid Passport.']);
        } else {

            $order = PassportOrder::create([
                'user_id' => auth()->user()->id,
                'name' => $request->consumer_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'price' => $request->price,
                'passport_id' => $passport_id,
                'payment_id' => 'pay_' . str_shuffle("FRENCHBREWW") . rand(10, 999),
                'status' => 0,
                'order_date' => date('Y-m-d')
            ]);


            return response()->json([
                'success' => 1,
                'message' => 'Order Created',
                'order_id' => $order->id,
                'price' => $request->price,
                'payment_id' => $order->payment_id,
            ]);
        }
    }

    public function passportConfirmSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'payment_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->validate();
        }

        $order_id = $request->id;
        $payment_id = $request->payment_id;
        $payment_date = date('Y-m-d');

        $order = PassportOrder::where('id', $order_id)->where('user_id', auth()->user()->id)->where('status', 0)->first();
        $passportorders = PassportOrder::where('user_id',auth()->user()->id)->count();
        if (!$order) {
            return response()->json([
                'success' => 0,
                'message' => 'Invalid Order.',
            ]);
        } else {

            $passport = Passport::where('id', $order->passport_id)->first();
            $volume = $remaining_amount = $passport->volume;
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d', strtotime('+1 year'));
            $passport_code = generatePassportCode();

            $obj = PassportOrder::firstOrNew(['id' => $order_id]);
            $obj->payment_date = $payment_date;
            $obj->payment_id = $payment_id;
            $obj->passport_code = $passport_code;
            $obj->volume_amount = $volume;
            $obj->remaining_amount = $remaining_amount;
            $obj->start_date = $start_date;
            $obj->end_date = $end_date;
            $obj->status = 1;
            $obj->save();
        // echo '<pre>request - '; print_r($passportorders); die;
            
if($passportorders == 1){
    User::where('id',auth()->user()->id)->update([
        'orderType'=>1,
        'passport_order'=>$order->id,
    ]);

}
         

            $pass_arr = array();
            $passport_data = PassportOrder::firstOrNew(['id' => $order_id]);

            $pass_arr['passport_code'] = $passport_data->passport_code;
            $pass_arr['phone'] = $passport_data->User->phone;
            $pass_arr['email'] = $passport_data->User->email;
            $pass_arr['price'] = $passport_data->price;
            $pass_arr['volume'] = $passport_data->volume_amount;
            $pass_arr['validity'] = $passport_data->start_date . ' - ' . $passport_data->end_date;

            return response()->json([
                'success' => 1,
                'message' => 'Payment Success',
                'id' => $order_id,
            ]);
        }
    }

    public function payment_submit(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all()); 
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($request->pay_id);

        $pay_data = array(
            'payment_id' => $request->pay_id,
            'payment_date' => date('Y-m-d'),
            'pay_status' => $request->status,
            'pay_res' => json_encode($payment->toArray())
        );

        PassportOrder::where(['id' => $request->id])->update($pay_data);

        $getOrder = PassportOrder::where(['id' => $request->id])->first();
        //   echo '<pre>pay_data - '; print_r($getOrder->toArray()); die;
        $pay_data_hstry = array(
            'passport_order_id' => $getOrder->id,
            'user_id' => auth()->user()->id,
            'name' => $getOrder->name,
            'phone' => $getOrder->phone,
            'email' => $getOrder->email,
            'price' => $getOrder->price,
            'passport_id' => $getOrder->passport_id,
            'status' => $getOrder->status,
            'volume_amount' => $getOrder->volume_amount,
            'used_amount' => $getOrder->used_amount,
            'remaining_amount' => $getOrder->remaining_amount,
            'payment_id' => $getOrder->payment_id,
            'payment_date' => $getOrder->payment_date,
            'pay_status' => $getOrder->pay_status,
            'pay_res' => json_encode($payment->toArray()),
            'order_date' => $getOrder->order_date,
            'start_date' => $getOrder->start_date,
            'end_date' => $getOrder->end_date,
            'is_custom' => $getOrder->is_custom

        );
        PassportOrderHistory::insert($pay_data_hstry);

        if ($request->status == 1) {
            Cart::destroy();
            return response()->json(['status' => 1, 'msg' => 'Payment Success', 'id' => $request->id]);
        } elseif ($request->status == 2) {
            return response()->json(['status' => 2, 'msg' => 'Payment Failed', 'id' => $request->id]);
        }
    }
}
