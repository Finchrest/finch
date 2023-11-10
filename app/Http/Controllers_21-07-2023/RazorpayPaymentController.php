<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use App\Models\Passport;
use App\Models\PassportOrder;
  
class RazorpayPaymentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {        
        // $p = PassportOrder::where('id',$request->id);
        $p = PassportOrder::where('id',41);
        $data['passportOrder'] = $pass = $p->first();
        // echo '<pre>passportOrder - '; print_r($data['passportOrder']->toArray()); die;
        
        // $view = view('razorpayView',$data);
        // return response()->json(['success'=>1,'view'=>$view->render()]); die;
        return view('razorpayView',$data);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
		//echo "dd"; die;
        $input = $request->all();
  
        // echo '<pre>input - '; print_r($input);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        
        // echo '<pre>api - '; print_r($api); die;
        
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        
       //echo '<pre>payment - '; print_r($payment); die;
        
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
             
               // echo '<pre>response - '; print_r($response); die;
        
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
          
        Session::put('success', 'Payment successful');
        return redirect()->back();
    }
}