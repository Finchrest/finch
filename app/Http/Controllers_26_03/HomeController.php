<?php

namespace App\Http\Controllers;


use App\Models\Banner;
use App\Models\Place;
use App\Models\Product;
use App\Models\Location;
use App\Models\User;
use App\Models\Offer;
use App\Models\PassportPage;
use App\Models\ProductMeta;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use DB;
use Cart;

class HomeController extends Controller
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
        
        // Session::flush();

        $data['setLocation'] = $getLocation = session('location');
        $data['userAge'] = $userAge = session('age');
        // echo $userAge; die;
        $data['banners'] = Banner::select('id','name','file_id')->where('status',1)->get();

        if(!empty(auth()->user()->id) && auth()->user()->age >= 21){
            $p = Product::where(['status'=>1,'type'=>1]);
            if(!empty($getLocation)){
                $p->where('location',$getLocation);
            }
            $data['products'] = $p->get();
        }elseif(!empty(auth()->user()->id) && auth()->user()->age < 21){
            $data['products'] = '';
        }elseif(!empty($userAge) && $userAge < 21){
            $data['products'] = '';
        }else{
            $p = Product::where(['status'=>1,'type'=>1]);
            if(!empty($getLocation)){
                $p->where('location',$getLocation);
            }
            $data['products'] = $p->get();
        }

        if(!empty($getLocation)){
            $data['places'] = Place::where(['location'=>$getLocation,'status'=>1])->get();
        }else{
            $data['places'] = Place::where('status',1)->get();
        }
        
        $data['locations'] = Location::where('status',1)->get();

        $off = Offer::where('status',1);
        if(!empty($getLocation)){
            $off->whereRaw("find_in_set('$getLocation',locations) > 0");
        }
        $data['offers'] = $off->get();
        $data['insta_datas'] = DB::table('insta_feeds')->get();
        
        
        $pass = PassportPage::all();
        $pass_arr=array();
        foreach($pass as $v){
            $pass_arr[$v->slug]=$v;
        
        }
        $data['passport']=$pass_arr;

        // echo '<pre>offers - '; print_r($data['passport']); die;
        return view('home',$data);
    }

    // public function test_home(){
    //     $insta_data = $instafeed = DB::table('insta_feeds')->get();

    //     // $insta_data = json_decode($data);
    //     echo '<pre>data - '; print_r($insta_data); die;
    //     // echo '<pre>data - '; print_r($insta_data->media->data[0]); die;
    
    //     $m_data_arr = array();
    
    //     foreach($insta_data->media->data as $k => $media){
    //         $m_data = file_get_contents("https://graph.facebook.com/v12.0/".$media->id."?fields=media_product_type,media_url,media_type,username,thumbnail_url,video_title&transport=cors&access_token=EAADDjp0KELABAAFmkZAehmKSLYn257npO9ufR8n1hjZBdsPZA9DzaABKclA0JdNingLhYzFNotCK4Nl3hKZBQtTRWZBQZBk9iZCqsFYMDAxfJdbbQAOTeFSiZABl3omfIq7EhE35Hojw4RWCz9ia3B9ukWT6V5aFy58OAhau0VKDvc2zi7fWfCcBgZAMuMu1SYYBCr1e1txXYG61MlYJ2ExghwJogNiXeFjAZD");
    //          $m_data_arr[$k] = json_decode($m_data);
    
    //          $ins_data = array(
    //             'feed_id' => $m_data_arr[$k]->id,
    //             'media_product_type' => $m_data_arr[$k]->media_product_type,
    //             'media_type' => $m_data_arr[$k]->media_type,
    //             'username' => $m_data_arr[$k]->username,
    //             'media_url' => $m_data_arr[$k]->media_url,
    //             'status' => 1,
    //             'created_at' => time(),
    //             'updated_at' => time(),
    //          );
    //          // echo '<pre>ins_data - '; print_r($ins_data); //die;
    //         //  $fields = '`' . implode('`, `', array_keys($ins_data)) . '`';
    //         //  $ndata = '\'' . implode('\', \'', $ins_data) . '\'' ;
    
    //         //  $this->checkFeed($m_data_arr[$k]->id,$ins_data);
    //     }
    //     echo '<pre>m_data_arr - '; print_r($m_data_arr); die;
    // }

    public function product($id='')
    { 
    $data['place']=$id;
    $data['drink_count'] = $drink_count = Product::where(['products.place'=>$id,'products.status'=>1,'products.type'=>1])->select('products.*','places.location')->join('places', 'places.id', '=', 'products.place')->count();
    
    $data['meals_count'] = $meals_count = Product::where(['products.place'=>$id,'products.status'=>1,'products.type'=>2])->select('products.*','places.location')->join('places', 'places.id', '=', 'products.place')->count();
    
    $type=1;
    $total=$drink_count;
    if($drink_count == 0){
    $type=2;
    $total=$meals_count;
    }
    
    
    
        
    $data['type']=$type;
    $data['total']=$total;
    
        
        if(!empty(auth()->user()->age)){
            $data['user_age'] = auth()->user()->age;
            
        }else{
            $data['user_age'] = '30';
        }
        

        $off = Offer::where('status',1);
        if(!empty($getLocation)){
            $off->whereRaw("find_in_set('$getLocation',locations) > 0");
        }
        $data['offers'] = $off->get();
       
       
       $data['cart'] = $this->getCartProduct();
      //echo '<pre>';print_R($data['cart']);die;
        return view('product',$data);
    }
    
    public function getCartProduct(){
        $content = Cart::content();
        // echo '<pre>content - '; print_r($content->toArray()); die;
        $product_arr=array();
        $i=0;
        foreach($content as $con){ 
            $product_arr[$con->id]['row_id']=$con->rowId;
            $product_arr[$con->id]['id']=$con->id;
            $product_arr[$con->id]['name']=$con->name;
            $product_arr[$con->id]['qty']=$con->qty;
            $product_arr[$con->id]['price']=number_format($con->price,2);
            $product_arr[$con->id]['image']=$con->options->image;
            $product_arr[$con->id]['place_id']=$con->options->place_id;
            $product_arr[$con->id]['product_tax']=$con->options->product_tax;
            $product_arr[$con->id]['product_price']=$con->options->product_price;
            $product_arr[$con->id]['total_price']=$con->options->total_price;
            $product_arr[$con->id]['tax']=$con->tax;
            $product_arr[$con->id]['subtotal']=$con->subtotal;
            $product_arr[$con->id]['product_type']=$con->options->product_type;
            
            //echo '<pre>';print_R($product_arr);die;
            $i++;
        }
        return $product_arr;
    }
    
    
    public function get_products(Request $request)
    {  
        $type = $request->type;
        $place=$request->place;
        $total=0;
        if($type == 1){
            $total=$request->drink_count;
        }else{
            $total=$request->meals_count;
        }
        
         if(!empty(auth()->user()->age)){
            $data['user_age'] = auth()->user()->age;
        }else{
            $data['user_age'] = '30';
        }
        
        
        
        $data['total']=$total;
        $data['type']=$type;
        $data['place']=$place;
        
        if($request->_totalCurrentResult ==0){

            $data['products'] = Product::where(['products.place'=>$place,'products.status'=>1,'products.type'=>$type])->select('products.*','places.location')->join('places', 'places.id', '=', 'products.place')->take(12)->get();

        }else{
            $data['products'] = Product::where(['products.place'=>$place,'products.status'=>1,'products.type'=>$type])->select('products.*','places.location')->join('places', 'places.id', '=', 'products.place')->skip($request->_totalCurrentResult)->take(12)->get();
        }
        
        $data['cart'] = $this->getCartProduct();
        $view = view('get_products',$data)->render();
        return response()->json(['success'=>1,'view'=>$view]);
    }

    public function about()
    {
        $data['insta_datas'] = DB::table('insta_feeds')->get();
        return view('about',$data);
    }

    public function our_services()
    {
        $data['insta_datas'] = DB::table('insta_feeds')->get();
        return view('services',$data);
    }

    public function instagram_feeds()
    {
        $data['insta_datas'] = DB::table('insta_feeds')->get();
        // $data['insta_datas'] = DB::table('insta_feeds_shubham')->get();
        return view('insta_feeds',$data);
    }

    public function contact()
    {
        $data = array();
        if(auth()->user()){
            $data['name'] = auth()->user()->name;
            $data['email'] = auth()->user()->email;
            $data['phone'] = auth()->user()->phone;
        }
        $data['insta_datas'] = DB::table('insta_feeds')->get();

        return view('contact',$data);
    }

    public function orders()
    {
        return view('orders');
    }

    public function information()
    {
        $data['getLocation'] = $getLocation = session('location');
        
        if(!empty($getLocation)){ 
            $data['places'] = Place::where(['location'=>$getLocation,'status'=>1])->get();
        }else{
            return redirect('/');
        }

        // echo '<pre>places - '; print_r($data['places']->toArray()); die;
        return view('information',$data);
    }

    public function information_details($id)
    {
        $data['getLocation'] = $getLocation = session('location');

        $plc = Place::where(['id'=>$id,'status'=>1]);
        if($getLocation){
           // $plc->where('location',$getLocation);
        }
        $data['place'] = $plc->first();
        //echo "<pre>"; print_r($data['place']); die;
        $data['placeImage'] = asset($data['place']->FileId->file);
        $data['place_images'] = get_place_image_explode($data['place']->file_ids);

        // echo '<pre>places - '; print_r($data['place']->toArray()); die;
        return view('information_details',$data);
    }

    public function productView(Request $request)
    {
        // echo '<pre>'; print_r($request->all()); die;
        if($request->row_id && $request->qty){
            $data['row_id'] = $request->row_id;
            $data['qty'] = $request->qty;
        }else{
            $data['product'] = Product::where(['id'=>$request->id,'status'=>1])->first();
            $data['pimage'] = asset($data['product']->FileId->file);

            $attr = array();
            $meta_arr = ProductMeta::where(['product_id'=>$request->id])->get()->toArray();
            if (is_array($meta_arr) && !empty($meta_arr)) {
                $attr_id = $meta_arr[0]['attribute_id'];
                foreach ($meta_arr as $key => $value) {          
                    $attr[$key]['attr_id']  = $attr_id;     

                    /*print_r($attr_id);
                    $aas = Attribute::select('name')->where(['id'=>$attr_id])->toSql();

                    dd($aas);*/

                    $attr_name = array_values(Attribute::where(['id'=>$attr_id])->first()->toArray());
                    //echo 'sdf';
                    //print_r($attr_name[1]);  die; 

                    $attr[$key]['attr_name']  = $attr_name[1];
                    $attr[$key]['option_id']  = $value['option_id'];
                    $option_name  = array_values(AttributeOption::select('option_name')->where(['id'=>$value['option_id']])->first()->toArray());
                    $attr[$key]['option_name'] = $option_name[0];
                    $attr[$key]['regular_price'] = $value['regular_price'];
                    $attr[$key]['tax'] = $value['tax'];
                    $attr[$key]['total_price'] = $value['regular_price'] + ($value['regular_price'] * $value['tax']) / 100;
                }
            }

            //echo '<pre>'; print_r($attr); die;

            $data['attr'] = $attr;
        }

        // echo '<pre>data - '; print_r($data['meta']->toArray()); die;
        $view = view('product_view',$data);
        return response()->json(['success'=>1,'view'=>$view->render()]);
    }

    public function changeLocations(Request $request)
    {
        // echo '<pre>'; print_r($request->all()); die;
        $data['setLocation'] = session('location');
        $data['locations'] = Location::where('status',1)->get();
        $view = view('change_location_view',$data);
        return response()->json(['success'=>1,'view'=>$view->render()]);
    }

    public function setLocations(Request $request)
    {
        // echo '<pre>'; print_r($request->all()); die;
        $age = '';
        $location = Location::where(['id'=>$request->location_id,'status'=>1])->first();
        $request->session()->put('location',$request->location_id);
        $request->session()->put('location_name',$location->name);
        if(!empty(auth()->user()->id) && !empty(auth()->user()->age)){
            $request->session()->put('age',auth()->user()->age);
            $age = session('age');
        }else{
            $age = session('age');
        }
        
        // echo $age; die;
        return response()->json(['success'=>1,'message'=>'Location Change Successfully','age'=>$age,'url'=>url('information')]);
    }
    
    public function cloaseLocationsModal(Request $request)
    {
        $request->session()->put('location_modal',1);
        return response()->json(['success'=>1]);
    }

    public function ageSubmit(Request $request){
        // echo '<pre>'; print_r($request->all()); die;
        $request->session()->put('age',$request->age[0]);
        $age = session('age');
        return response()->json(['success'=>1,'age'=>$age,'message'=>'Age Update Successfully','age'=>$age,'pid'=>$request->age_product_id]);
    }
    
    public function profileView(Request $request){
        // echo '<pre>'; print_r($request->all()); die;
        // echo '<pre>'; print_r(auth()->user()); die;
        $data['id'] = auth()->user()->id;
        $data['name'] = auth()->user()->name;
        $data['email'] = auth()->user()->email;
        $data['age'] = auth()->user()->age;
        if(!empty(auth()->user()->phone)){ 
            $data['phone'] = auth()->user()->phone;
        }
        // echo '<pre>data - '; print_r($data['product']->toArray()); die;
        $view = view('front/users/userProfileUpdate',$data);
        return response()->json(['success'=>1,'view'=>$view->render()]);
    }
    
    public function updateUser(Request $request){
        // echo '<pre>'; print_r($request->all()); die;
       
        if($request->email != auth()->user()->email){
            $is_unique = 'unique:users';
        }else{
            $is_unique = '';
        }
        if($request->phone != auth()->user()->phone){
            $is_phone_unique = 'unique:users';
        }else{
            $is_phone_unique = '';
        }
        $validator =Validator::make($request->all(),
        [
            'name'       => 'required',
            'email'         => 'required|email|'.$is_unique,
            'phone'         => 'required|digits:10|'.$is_phone_unique,
            'age'       => 'required',
        ]);
    
        if ($validator->fails()) {
            return $validator->validate();
        }else{

            $data = array(
                'name' => ucwords($request->name),
                'email' => $request->email,
                'phone' => $request->phone,
                'age' => $request->age,
                'is_new' => 0,
            );
            User::where('id',auth()->user()->id)->update($data);
            $request->session()->put('age',$request->age);
            return response()->json(['success'=>1,'message'=>'Profile Update Successfully']);
        }
    }
    
    public function contact_form(Request $request){
        // echo '<pre>'; print_r($request->all()); die;
        $validator =Validator::make($request->all(),
        [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|digits:10',
            'message' => 'required',
        ]);
    
        if ($validator->fails()) {
            return $validator->validate();
        }else{
            $data = array(
                'name' => ucwords($request->name),
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
                'created_at' => time(),
                'updated_at' => time(),
            );
            DB::table('user_enquiry')->insert($data);
            return response()->json(['success'=>1,'message'=>'Thanking You for contacting us. We will getting you reach as soon...']);
        }
    }
    
    
    public function privacy_policy()
    {
        return view('privacy_policy');
    }

}
