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
use App\Models\GeneralSetting;
use App\Models\PassportOrder;
use App\Models\Order;
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
        $uid = session('uid');

        $logo =  Session::forget('logo_image');
        // Session::flush();
        $currentDate = date('Y-m-d');
        if ($uid) {
            $allPassports = PassportOrder::where(['user_id' => $uid, 'status' => 1])->get();
            foreach ($allPassports as $allPassport) {
                if ($currentDate > $allPassport->end_date) {
                    // echo"<pre>";print_r($allPassport->toArray());
                    PassportOrder::where(['user_id' => $uid, 'id' => $allPassport->id])->update(['status' => 0]);
                }
            }
        }
        //  die;
        //    echo"<pre>";print_r($allPassports->toArray());die;

        $data['setLocation'] = $getLocation = session('location');
        $data['userAge'] = $userAge = session('age');
        // echo $userAge; die;
        $data['banners'] = Banner::select('id', 'name', 'file_id')->where('status', 1)->get();

        if (!empty(auth()->user()->id) && auth()->user()->age >= 21) {
            $p = Product::where(['status' => 1, 'type' => 1, 'location' => 2, 'is_home' => 1]);
            if (!empty($getLocation)) {
                $p->where('location', $getLocation);
            }
            $data['products'] = $p->get();
        } elseif (!empty(auth()->user()->id) && auth()->user()->age < 21) {
            $data['products'] = '';
        } elseif (!empty($userAge) && $userAge < 21) {
            $data['products'] = '';
        } else {
            $p = Product::where(['status' => 1, 'type' => 1, 'is_home' => 1]);
            if (!empty($getLocation)) {
                $p->where('location', $getLocation);
            }
            $data['products'] = $p->get();
        }

        if (!empty($getLocation)) {
            $data['places'] = Place::where(['location' => $getLocation, 'status' => 1])->get();
        } else {
            $data['places'] = Place::where('status', 1)->get();
        }

        $data['locations'] = Location::where('status', 1)->get();

        $off = Offer::where('status', 1);
        if (!empty($getLocation)) {
            //$off->whereRaw("find_in_set('$getLocation',locations) > 0");
            $off->where('locations', $getLocation);
        }
        $data['offers'] = $off->get();
        $data['insta_datas'] = DB::table('insta_feeds')->get();


        $pass = PassportPage::all();
        $pass_arr = array();
        foreach ($pass as $v) {
            $pass_arr[$v->slug] = $v;
        }
        $data['passport'] = $pass_arr;
        $data['instaPosts'] = DB::table('insta_feeds')->where('status', 1)->orderBy('post_time', 'DESC')->get();

        @$minimumAmount = GeneralSetting::where('id', 8)->first();
        @$Passport_Minimum_Amount = $minimumAmount->meta_value;

        @$remainAmounts = PassportOrder::where('user_id', auth()->user()->id)->get();

        @$remain_amount = 0;
        if (!empty($remainAmounts->toArray())) {
            foreach (@$remainAmounts as $remainAmount) {
                @$remain_amount += @$remainAmount->remaining_amount;
            }
        }

        $data['remain_amount'] = $remain_amount;
        $data['Passport_Minimum_Amount'] = $Passport_Minimum_Amount;
        $data['is_model_open'] = Session::get('is_model_open');
        return view('home', $data);
    }

    public function OrderType()
    {

        $uid = session('uid');

        $passportorders = PassportOrder::where('user_id', $uid)->count();

        User::where('id', $uid)->update([
            'orderType' => null,
            'passport_order' => null,
        ]);

        return view('order_type', compact('uid', 'passportorders'));
    }



    public function home_passport_select()
    {

        $uid = session('uid');
        $logo =  Session::forget('logo_image');
        // Session::flush();
        $currentDate = date('Y-m-d');
        if ($uid) {
            $allPassports = PassportOrder::where(['user_id' => $uid, 'status' => 1])->get();
            foreach ($allPassports as $allPassport) {
                if ($currentDate > $allPassport->end_date) {
                    // echo"<pre>";print_r($allPassport->toArray());
                    PassportOrder::where(['user_id' => $uid, 'id' => $allPassport->id])->update(['status' => 0]);
                }
            }
        }
        //  die;
        //    echo"<pre>";print_r($allPassports->toArray());die;

        $data['setLocation'] = $getLocation = session('location');
        $data['userAge'] = $userAge = session('age');
        // echo $userAge; die;
        $data['banners'] = Banner::select('id', 'name', 'file_id')->where('status', 1)->get();

        if (!empty(auth()->user()->id) && auth()->user()->age >= 21) {
            $p = Product::where(['status' => 1, 'type' => 1, 'location' => 2, 'is_home' => 1]);
            if (!empty($getLocation)) {
                $p->where('location', $getLocation);
            }
            $data['products'] = $p->get();
        } elseif (!empty(auth()->user()->id) && auth()->user()->age < 21) {
            $data['products'] = '';
        } elseif (!empty($userAge) && $userAge < 21) {
            $data['products'] = '';
        } else {
            $p = Product::where(['status' => 1, 'type' => 1, 'is_home' => 1]);
            if (!empty($getLocation)) {
                $p->where('location', $getLocation);
            }
            $data['products'] = $p->get();
        }

        if (!empty($getLocation)) {
            $data['places'] = Place::where(['location' => $getLocation, 'status' => 1])->get();
        } else {
            $data['places'] = Place::where('status', 1)->get();
        }

        $data['locations'] = Location::where('status', 1)->get();

        $off = Offer::where('status', 1);
        if (!empty($getLocation)) {
            //$off->whereRaw("find_in_set('$getLocation',locations) > 0");
            $off->where('locations', $getLocation);
        }
        $data['offers'] = $off->get();
        $data['insta_datas'] = DB::table('insta_feeds')->get();


        $pass = PassportPage::all();
        $pass_arr = array();
        foreach ($pass as $v) {
            $pass_arr[$v->slug] = $v;
        }
        $data['passport'] = $pass_arr;
        $data['instaPosts'] = DB::table('insta_feeds')->where('status', 1)->orderBy('post_time', 'DESC')->get();

        @$minimumAmount = GeneralSetting::where('id', 8)->first();
        @$Passport_Minimum_Amount = $minimumAmount->meta_value;

        @$remainAmounts = PassportOrder::where('user_id', auth()->user()->id)->get();

        @$remain_amount = 0;
        if (!empty($remainAmounts->toArray())) {
            foreach (@$remainAmounts as $remainAmount) {
                @$remain_amount += @$remainAmount->remaining_amount;
            }
        }

        $data['remain_amount'] = $remain_amount;
        $data['Passport_Minimum_Amount'] = $Passport_Minimum_Amount;
        $data['is_model_open'] = Session::get('is_model_open');
        return view('home', $data);
    }


    public function product($slug = '')
    {
        //echo "string";die;
        $data['slug_name'] = $slug;
        $plce = DB::table('places')
            ->select(DB::raw('id'))
            ->where('id', $slug)
            ->get();
        $plce_id = $plce[0]->id;
        $data['place'] = $plce_id;
        $data['drink_count'] = $drink_count = Product::where(['products.place' => $plce_id, 'products.status' => 1, 'products.type' => 1])->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->count();

        $data['meals_count'] = $meals_count = Product::where(['products.place' => $plce_id, 'products.status' => 1, 'products.type' => 2])->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->count();

        $type = 1;
        $total = $drink_count;
        if ($drink_count == 0) {
            $type = 2;
            $total = $meals_count;
        }

        $data['type'] = $type;
        $data['total'] = $total;

        if (!empty(auth()->user()->age)) {
            $data['user_age'] = auth()->user()->age;
        } else {
            $data['user_age'] = '30';
        }


        $off = Offer::where('status', 1);
        if (!empty($getLocation)) {
            $off->whereRaw("find_in_set('$getLocation',locations) > 0");
        }
        $data['offers'] = $off->get();

        $data['cart'] = $this->getCartProduct();

        return view('product', $data);
    }

    public function getCartProduct()
    {
        $content = Cart::content();
        // echo '<pre>content - '; print_r($content->toArray()); die;
        $product_arr = array();
        $i = 0;
        foreach ($content as $con) {
            $product_arr[$con->id]['row_id'] = $con->rowId;
            $product_arr[$con->id]['id'] = $con->id;
            $product_arr[$con->id]['name'] = $con->name;
            $product_arr[$con->id]['qty'] = $con->qty;
            $product_arr[$con->id]['price'] = number_format($con->price, 2);
            $product_arr[$con->id]['image'] = $con->options->image;
            $product_arr[$con->id]['place_id'] = $con->options->place_id;
            $product_arr[$con->id]['product_tax'] = $con->options->product_tax;
            $product_arr[$con->id]['product_price'] = $con->options->product_price;
            $product_arr[$con->id]['total_price'] = $con->options->total_price;
            $product_arr[$con->id]['tax'] = $con->tax;
            $product_arr[$con->id]['subtotal'] = $con->subtotal;
            $product_arr[$con->id]['product_type'] = $con->options->product_type;

            //echo '<pre>';print_R($product_arr);die;
            $i++;
        }
        return $product_arr;
    }

    public function drinksProduct(Request $request)
    {
        $logo =  Session::forget('logo_image');
        $slug_segment = request()->segment(2);
        // echo "<pre>";print_R($slug_segment);die;
        $plce = DB::table('places')
            ->select(DB::raw('id,name,location,slug,status'))
            ->where('slug', $slug_segment)
            ->get();
        $plce_id = $plce[0]->id;
        $data['slug_name'] = $plce[0]->slug;
        $data['place'] = $plce_id;

        $data['drink_count'] = $drink_count = Product::where(['products.place' => $plce_id, 'products.status' => 1, 'products.type' => 1])->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->count();

        $data['meals_count'] = $meals_count = Product::where(['products.place' => $plce_id, 'products.status' => 1, 'products.type' => 2])->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->count();

        $type = 1;
        $total = $drink_count;
        if ($drink_count == 0) {
            $type = 2;
            $total = $meals_count;
        }

        $data['type'] = $type;
        $data['total'] = $total;

        if (!empty(auth()->user()->age)) {
            $data['user_age'] = auth()->user()->age;
        } else {
            $data['user_age'] = '30';
        }


        $off = Offer::where('status', 1);
        if (!empty($getLocation)) {
            $off->whereRaw("find_in_set('$getLocation',locations) > 0");
        }
        $data['offers'] = $off->get();

        $data['cart'] = $this->getCartProduct();
        $cats = Product::select(DB::raw('group_concat(category) as cat_ids'))
            ->where('status', 1)->where('type', 1)->where('place', $plce_id)
            ->first();

        $cat_id_arr = array_unique(explode(',', $cats->cat_ids));

        $data['categories'] = DB::table('categories')->where('status', 1)->whereIn('id', $cat_id_arr)->get();
        @$data['user'] = User::where('id', Auth::user()->id)->first();
        // echo "<pre>";print_R($data);die;
        return view('drinks_product', $data);
    }



    public function mealsProduct(Request $request)
    {
        $slug_segment = request()->segment(2);
        // echo "<pre>";print_R($slug_segment);die;
        $plce = DB::table('places')
            ->select(DB::raw('id,name,location,slug,status'))
            ->where('slug', $slug_segment)
            ->get();
        $plce_id = $plce[0]->id;
        $data['slug_name'] = $plce[0]->slug;
        $data['place'] = $plce_id;
        $cate_ids = $request->cat_value;

        $data['drink_count'] = $drink_count = Product::where(['products.place' => $plce_id, 'products.status' => 1, 'products.type' => 1])->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->count();

        $data['meals_count'] = $meals_count = Product::where(['products.place' => $plce_id, 'products.status' => 1, 'products.type' => 2])->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->count();

        $type = 1;
        $total = $drink_count;
        if ($drink_count == 0) {
            $type = 2;
            $total = $meals_count;
        }

        $data['type'] = $type;
        $data['total'] = $total;

        if (!empty(auth()->user()->age)) {
            $data['user_age'] = auth()->user()->age;
        } else {
            $data['user_age'] = '30';
        }


        $off = Offer::where('status', 1);
        if (!empty($getLocation)) {
            $off->whereRaw("find_in_set('$getLocation',locations) > 0");
        }
        $data['offers'] = $off->get();

        $cats = Product::select(DB::raw('group_concat(category) as cat_ids'))
            ->where('status', 1)->where('type', 2)->where('place', $plce_id)
            ->first();

        $cat_id_arr = array_unique(explode(',', $cats->cat_ids));

        $data['categories'] = DB::table('categories')->where('status', 1)->whereIn('id', $cat_id_arr)->get();
        $data['cart'] = $this->getCartProduct();

        return view('meals_products', $data);
    }


    public function get_products(Request $request)
    {

        $type = $request->type;
        $place = $request->place;
        $catid = $request->cat_value;
        $cat_filter = explode(",", $catid);
        $search_data = $request->search_text;
        $total = 0;
        if ($type == 1) {
            $total = $request->drink_count;
        } else {
            $total = $request->meals_count;
        }

        if (!empty(auth()->user()->age)) {
            $data['user_age'] = auth()->user()->age;
        } else {
            $data['user_age'] = '30';
        }

        $data['total'] = $total;
        $data['type'] = $type;
        $data['place'] = $place;

        if ($request->_totalCurrentResult == 0) {

            $data['products'] = Product::where(['products.place' => $place, 'products.status' => 1, 'products.type' => $type, 'products.for_passport' => 0])->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->take(12)->get();
        } else {
            $data['products'] = Product::where(['products.place' => $place, 'products.status' => 1, 'products.type' => $type, 'products.for_passport' => 0])->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->skip($request->_totalCurrentResult)->take(12)->get();
        }


        $data['cart'] = $this->getCartProduct();

        $view = view('get_products', $data)->render();


        return response()->json(['success' => 1, 'view' => $view]);
    }

    public function getFilter(Request $request)
    {
        $type = $request->type;
        $place = $request->place;
        $catid = $request->cat_value;
        $cat_filter = explode(",", $catid);
        $search_data = $request->search_text;
        $data['type'] = $type;
        $data['place'] = $place;
        if ($catid != '') {
            if ($request->_totalCurrentResult == 0) {
                $data['drink_count'] = $drink_count = Product::where(['products.place' => $place, 'products.status' => 1, 'products.type' => 1])->whereIn('category', $cat_filter)->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->count();

                $data['meals_count'] = $meals_count = Product::where(['products.place' => $place, 'products.status' => 1, 'products.type' => 2])->whereIn('category', $cat_filter)->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->count();
                // echo "<pre>";print_R($data['meals_count']);

                $data['products'] = Product::where(['products.place' => $place, 'products.status' => 1, 'products.type' => $type])->whereIn('category', $cat_filter)->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->take(12)->get();
            } else {
                $data['products'] = Product::where(['products.place' => $place, 'products.status' => 1, 'products.type' => $type])->whereIn('category', $cat_filter)->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->skip($request->_totalCurrentResult)->take(12)->get();
            }
        } else if ($search_data != '') {
            if ($request->_totalCurrentResult == 0) {
                $data['products'] = Product::where(['products.place' => $place, 'products.status' => 1, 'products.type' => $type])->where('products.title', 'like', "%" . $search_data . "%")->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->take(12)->get();
                //echo "<pre>";print_R($data['products']);die;
            } else {
                $data['products'] = Product::where(['products.place' => $place, 'products.status' => 1, 'products.type' => $type])->where('products.title', 'like', "%" . $search_data . "%")->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->skip($request->_totalCurrentResult)->take(12)->get();
            }
        } else {
            if ($request->_totalCurrentResult == 0) {

                $data['products'] = Product::where(['products.place' => $place, 'products.status' => 1, 'products.type' => $type])->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->take(12)->get();
            } else {
                $data['products'] = Product::where(['products.place' => $place, 'products.status' => 1, 'products.type' => $type])->select('products.*', 'places.location')->join('places', 'places.id', '=', 'products.place')->skip($request->_totalCurrentResult)->take(12)->get();
            }
        }

        $data['cart'] = $this->getCartProduct();
        $view = view('get_products', $data)->render();
        return response()->json(['success' => 1, 'view' => $view]);
    }

    public function about()
    {
        $data['instaPosts'] = DB::table('insta_feeds')->where('status', 1)->orderBy('post_time', 'DESC')->get();
        return view('about', $data);
    }

    public function our_services()
    {
        $data['instaPosts'] = DB::table('insta_feeds')->where('status', 1)->orderBy('post_time', 'DESC')->get();
        return view('services', $data);
    }

    public function instagram_feeds()
    {
        //$data['insta_datas'] = DB::table('insta_feeds')->get();
        $data['instaPosts'] = DB::table('insta_feeds')->where('status', 1)->orderBy('post_time', 'DESC')->get();
        //echo '<pre>';print_r($data['instaPosts']);die;
        // $data['insta_datas'] = DB::table('insta_feeds_shubham')->get();
        return view('insta_feeds', $data);
    }

    public function contact()
    {
        $data = array();
        if (auth()->user()) {
            $data['name'] = auth()->user()->name;
            $data['email'] = auth()->user()->email;
            $data['phone'] = auth()->user()->phone;
        }
        $data['instaPosts'] = DB::table('insta_feeds')->where('status', 1)->orderBy('post_time', 'DESC')->get();

        return view('contact', $data);
    }

    public function orders()
    {
        return view('orders');
    }

    public function information()
    {
        $data['getLocation'] = $getLocation = session('location');

        if (!empty($getLocation)) {
            $data['places'] = Place::where(['location' => $getLocation, 'status' => 1])->get();
        } else {
            return redirect('/');
        }

        // echo '<pre>places - '; print_r($data['places']->toArray()); die;
        return view('information', $data);
    }

    public function information_details(Request $request, $slug)
    {
        // echo "<pre>";print_r($slug);die;
        $plce = DB::table('places')
            ->select(DB::raw('id'))
            ->where('slug', $slug)
            ->get();
        $plce_id = $plce[0]->id;
        //echo "<pre>";print_r($plce_id);die;
        //$plc = Place::where(['slug'=>$slug]);
        //echo "<pre>";print_r($plc);die;




        // echo "hello";die;
        $data['getLocation'] = $getLocation = $plce_id;
        //echo "<pre>";print_r($data['getLocation']);die;
        $plc = Place::where(['id' => $plce_id, 'status' => 1]);
        if ($getLocation) {
            // $plc->where('location',$getLocation);
        }
        $data['place'] = $plc->first();
        //echo "<pre>"; print_r($data['place']); die;
        $data['placeImage'] = asset($data['place']->FileId->file);
        $data['place_images'] = get_place_image_explode($data['place']->file_ids);
        if ($data['place']->file_id_logo == 0) {
            $request->session()->put('logo_image', 0);
        } else {
            $request->session()->put('logo_image', $data['place']->LogoId->file);
        }

        // echo '<pre>places - '; print_r($data['place']->toArray()); die;
        return view('information_details', $data);
    }

    public function productView(Request $request)
    {
        // echo '<pre>'; print_r($request->all()); die;
        if ($request->row_id && $request->qty) {
            $data['row_id'] = $request->row_id;
            $data['qty'] = $request->qty;
        } else {
            $data['product'] = Product::where(['id' => $request->id, 'status' => 1])->first();
            $data['pimage'] = asset($data['product']->FileId->file);

            $attr = array();
            $meta_arr = ProductMeta::where(['product_id' => $request->id])->get()->toArray();
            if (is_array($meta_arr) && !empty($meta_arr)) {
                $attr_id = $meta_arr[0]['attribute_id'];
                foreach ($meta_arr as $key => $value) {
                    $attr[$key]['attr_id']  = $attr_id;

                    /*print_r($attr_id);
                    $aas = Attribute::select('name')->where(['id'=>$attr_id])->toSql();

                    dd($aas);*/

                    $attr_obj = Attribute::where(['id' => $attr_id])->first();

                    if ($attr_obj) {
                        $attr_name = array_values($attr_obj->toArray());
                        $attr_name_str = $attr_name[1];
                    } else {
                        $attr_name_str = '';
                    }

                    //echo 'sdf';
                    //print_r($attr_name[1]);  die; 

                    $attr[$key]['attr_name']  = $attr_name_str;
                    $attr[$key]['option_id']  = $value['option_id'];
                    $option_name  = array_values(AttributeOption::select('option_name')->where(['id' => $value['option_id']])->first()->toArray());
                    $attr[$key]['option_name'] = $option_name[0];
                    $attr[$key]['regular_price'] = $value['regular_price'];
                    $attr[$key]['tax'] = $value['tax'];
                    $attr[$key]['total_price'] = $value['regular_price'] + ($value['regular_price'] * $value['tax']) / 100;
                }
            }

            //echo '<pre>'; print_r($attr); die;

            $data['attr'] = $attr;
        }

        // echo '<pre>data - '; print_r($data['product']->toArray()); die;
        $view = view('product_view', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }

    public function changeLocations(Request $request)
    {

        // echo '<pre>'; print_r($request->all()); die;
        $data['setLocation'] = session('location');
        $data['locations'] = Location::where('status', 1)->get();
        $view = view('change_location_view', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }

    public function setLocations(Request $request)
    {
        // echo '<pre>'; print_r($request->all()); die;
        $age = '';
        $location = Location::where(['id' => $request->location_id, 'status' => 1])->first();
        $request->session()->put('location', $request->location_id);

        if ($location->file_id_logo == 0) {
            $request->session()->put('logo_image', 0);
        } else {
            $request->session()->put('logo_image', $location->LogoId->file);
        }


        $request->session()->put('location_name', $location->name);
        if (!empty(auth()->user()->id) && !empty(auth()->user()->age)) {
            $request->session()->put('age', auth()->user()->age);
            $age = session('age');
        } else {
            $age = session('age');
        }

        // echo $age; die;
        return response()->json(['success' => 1, 'message' => 'Location Change Successfully', 'age' => $age, 'url' => url('information')]);
    }

    public function cloaseLocationsModal(Request $request)
    {
        $request->session()->put('location_modal', 1);
        return response()->json(['success' => 1]);
    }

    public function ageSubmit(Request $request)
    {
        // echo '<pre>'; print_r($request->all()); die;
        $request->session()->put('age', $request->age[0]);
        $age = session('age');
        return response()->json(['success' => 1, 'age' => $age, 'message' => 'Age Update Successfully', 'age' => $age, 'pid' => $request->age_product_id]);
    }

    public function profileViewData(Request $request)
    {
        $data['id'] = auth()->user()->id;
        $data['name'] = auth()->user()->name;
        $data['email'] = auth()->user()->email;
        $data['age'] = auth()->user()->age;
        $data['login_pin'] = auth()->user()->login_pin;
        if (!empty(auth()->user()->phone)) {
            $data['phone'] = auth()->user()->phone;
        }
        // echo '<pre>data - '; print_r($data['product']->toArray()); die;
        $view = view('front/users/userProfileUpdate', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }


    public function updateUser(Request $request)
    {
        // echo '<pre>'; print_r($request->all()); die;

        if ($request->email != auth()->user()->email) {
            $is_unique = 'unique:users';
        } else {
            $is_unique = '';
        }
        if ($request->phone != auth()->user()->phone) {
            $is_phone_unique = 'unique:users';
        } else {
            $is_phone_unique = '';
        }
        $validator = Validator::make(
            $request->all(),
            [
                'name'       => 'required',
                'email'         => 'required|email|' . $is_unique,
                'phone'         => 'required|digits:10|' . $is_phone_unique,
                'age'       => 'required',

            ]
        );

        if ($validator->fails()) {
            return $validator->validate();
        } else {

            $data = array(
                'name' => ucwords($request->name),
                'email' => $request->email,
                'phone' => $request->phone,
                'age' => $request->age,
                'is_new' => 0,
                'login_pin' => $request->login_pin,
            );
            User::where('id', auth()->user()->id)->update($data);
            $request->session()->put('age', $request->age);
            return response()->json(['success' => 1, 'message' => 'Profile Update Successfully']);
        }
    }

    public function contact_form(Request $request)
    {
        // echo '<pre>'; print_r($request->all()); die;
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required|digits:10',
                'message' => 'required',
            ]
        );

        if ($validator->fails()) {
            return $validator->validate();
        } else {
            $data = array(
                'name' => ucwords($request->name),
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
                'created_at' => time(),
                'updated_at' => time(),
            );
            DB::table('user_enquiry')->insert($data);
            return response()->json(['success' => 1, 'message' => 'Thanking You for contacting us. We will getting you reach as soon...']);
        }
    }


    public function privacy_policy()
    {
        $data['instaPosts'] = DB::table('insta_feeds')->where('status', 1)->orderBy('post_time', 'DESC')->get();
        return view('privacy_policy', $data);
    }

    public function frenchises_web()
    {
        $data = array();
        //$data['frenchises'] = DB::table('insta_feeds')->where('status',1)->orderBy('post_time', 'DESC')->get();
        return view('frenchises_web', $data);
    }

    public function frenchises_mob()
    {
        $data = array();
        //$data['frenchises'] = DB::table('insta_feeds')->where('status',1)->orderBy('post_time', 'DESC')->get();
        return view('frenchises_mob', $data);
    }




    public function remenberAmount()
    {

        @$minimumAmount = GeneralSetting::where('id', 8)->first();
        @$Passport_Minimum_Amount = $minimumAmount->meta_value;

        @$remainAmounts = PassportOrder::where('user_id', auth()->user()->id)->get();

        @$remain_amount = 0;
        if (!empty($remainAmounts->toArray())) {
            foreach (@$remainAmounts as $remainAmount) {
                @$remain_amount += @$remainAmount->remaining_amount;
            }
        }

        if ($remain_amount > 0) {

            if ($remain_amount < $Passport_Minimum_Amount) {
                $is_model_open = 1;
                Session::put('is_model_open', $is_model_open);
                // session()->put('is_model_open',$is_model_open);
            }
        }


        $view = view('front/users/rememberamount')->render();
        return response()->json(['success' => 1, 'view' => $view]);
    }
    public function showOrderTypePage()
    {
        $data = array();
        $view = view('showOrderType', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }


    // public function OrderTypeSave(Request $request){
    //     session()->put('orderType', $request->ordertype );
    //     return response()->json(['success' => 1]); 
    // }

    public function getpassport(Request $request)
    {
        session()->put('orderType', $request->typ);
        return response()->json(['success' => 1]);
    }

    public function getpassportselected(Request $request)
    {
        session()->forget('cart');
        session(['orderType' => $request->typ]);
        User::where('id', session('uid'))->update([
            'orderType' => $request->typ,
            'passport_order' => null,
        ]);
        return response()->json(['success' => 1]);
    }
    public function showOrderTypeHomePage()
    {
        $data = array();
        $view = view('order_type', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }
    public function paymentSuccessRedirect(Request $request)
    {
        $data['orderData'] = Order::where(['id' => $request->id])->first();

        $view = view('paymentSuccessRedirect', $data);
        return response()->json(['success' => 1, 'view' => $view->render()]);
    }
}
