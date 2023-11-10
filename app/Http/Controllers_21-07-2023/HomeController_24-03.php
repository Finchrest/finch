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
        $data['instaPosts'] = DB::table('insta_feeds')->where('status',1)->orderBy('post_time', 'DESC')->get();
        // echo '<pre> offers - '; print_r($data['instaPosts']); die;
        return view('home',$data);
    }


    public function product($slug=''){ 
        //echo "string";die;
        $data['slug_name'] = $slug;
        $plce = DB::table('places')
             ->select(DB::raw('id'))
             ->where('slug',$slug)
             ->get();
        $plce_id = $plce[0]->id;
    $data['place']=$plce_id;
    $data['drink_count'] = $drink_count = Product::where(['products.place'=>$plce_id,'products.status'=>1,'products.type'=>1])->select('products.*','places.location')->join('places', 'places.id', '=', 'products.place')->count();
    
    $data['meals_count'] = $meals_count = Product::where(['products.place'=>$plce_id,'products.status'=>1,'products.type'=>2])->select('products.*','places.location')->join('places', 'places.id', '=', 'products.place')->count();
    
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
    
     public function drinksProduct(Request $request)
    {  
        $slug_segment = request()->segment(2);
        // echo "<pre>";print_R($slug_segment);die;
        $plce = DB::table('places')
             ->select(DB::raw('id,name,location,slug,status'))
             ->where('slug',$slug_segment)
             ->get();
             // echo "<pre>";print_R($plce);die;
        $plce_id = $plce[0]->id;
        $data['slug_name'] = $plce[0]->slug;
    $data['place']=$plce_id;
    //echo "<pre>";print_R($data['slug_name']);die;
        $type = 1;
        // echo "<pre>";print_R($type);die;
        $place=$plce_id;
        //echo "<pre>";print_R($place);die;
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
        $data['type']=1;
        $data['type']=2;
        $data['place']=$place;
        
        $data['drink_count'] = $drink_count = Product::where(['products.place'=>$place,'products.status'=>1,'products.type'=>1])->select('products.*','places.location')->join('places', 'places.id', '=', 'products.place')->count();
        
    $data['meals_count'] = $meals_count = Product::where(['products.place'=>$place,'products.status'=>1,'products.type'=>2])->select('products.*','places.location')->join('places', 'places.id', '=', 'products.place')->count();
    //echo "<pre>";print_R($data['drink_count']);
    //echo "<pre>";print_R($data['meals_count']);die;

            $data['products'] = Product::where(['products.place'=>$place,'products.status'=>1,'products.type'=>1])->select('products.*','places.location')->join('places', 'places.id', '=', 'products.place')->take(12)->get();
        
        $data['cart'] = $this->getCartProduct();
        return view('drinks_product',$data);
    }   



     public function mealsProduct(Request $request)
    {  
        $slug_segment = request()->segment(2);
        // echo "<pre>";print_R($slug_segment);die;
        $plce = DB::table('places')
             ->select(DB::raw('id,name,location,slug,status'))
             ->where('slug',$slug_segment)
             ->get();
             // echo "<pre>";print_R($plce);die;
        $plce_id = $plce[0]->id;
        $data['slug_name'] = $plce[0]->slug;
    $data['place']=$plce_id;
    //echo "<pre>";print_R($data['slug_name']);die;
        $type = 2;
        // echo "<pre>";print_R($type);die;
        $place=$plce_id;
        //echo "<pre>";print_R($place);die;
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
        $data['type']=1;
        $data['type']=2;
        $data['place']=$place;
        
        $data['drink_count'] = $drink_count = Product::where(['products.place'=>$place,'products.status'=>1,'products.type'=>1])->select('products.*','places.location')->join('places', 'places.id', '=', 'products.place')->count();
        
    $data['meals_count'] = $meals_count = Product::where(['products.place'=>$place,'products.status'=>1,'products.type'=>2])->select('products.*','places.location')->join('places', 'places.id', '=', 'products.place')->count();
    //echo "<pre>";print_R($data['drink_count']);
    //echo "<pre>";print_R($data['meals_count']);die;


            $data['products'] = Product::where(['products.place'=>$place,'products.status'=>1,'products.type'=>2])->select('products.*','places.location')->join('places', 'places.id', '=', 'products.place')->skip($request->_totalCurrentResult)->take(12)->get();
        
        $data['cart'] = $this->getCartProduct();
        return view('meals_products',$data);
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
        $data['instaPosts'] = DB::table('insta_feeds')->where('status',1)->orderBy('post_time', 'DESC')->get();
        return view('about',$data);
    }

    public function our_services()
    {
        $data['instaPosts'] = DB::table('insta_feeds')->where('status',1)->orderBy('post_time', 'DESC')->get();
        return view('services',$data);
    }

    public function instagram_feeds()
    {
        //$data['insta_datas'] = DB::table('insta_feeds')->get();
        $data['instaPosts'] = DB::table('insta_feeds')->where('status',1)->orderBy('post_time', 'DESC')->get();
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
        $data['instaPosts'] = DB::table('insta_feeds')->where('status',1)->orderBy('post_time', 'DESC')->get();

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

    public function information_details($slug){
        // echo "<pre>";print_r($slug);die;
        $plce = DB::table('places')
             ->select(DB::raw('id'))
             ->where('slug',$slug)
             ->get();
        $plce_id = $plce[0]->id;
             //echo "<pre>";print_r($plce_id);die;
        //$plc = Place::where(['slug'=>$slug]);
        //echo "<pre>";print_r($plc);die;




        // echo "hello";die;
        $data['getLocation'] = $getLocation = $plce_id;
        //echo "<pre>";print_r($data['getLocation']);die;
        $plc = Place::where(['id'=>$plce_id,'status'=>1]);
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
        $data['instaPosts'] = DB::table('insta_feeds')->where('status',1)->orderBy('post_time', 'DESC')->get();
        return view('privacy_policy',$data);
    }

}
