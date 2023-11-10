<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\User;
// use App\Package;
// use App\Addon;
// use App\Question;
// use App\WordRange;
// use App\UploadImage;
// use App\ProductWordRange;
// use App\Notification;
// use App\NotificationType;


use App\Models\Product;
use App\Models\Home_address;
use App\Models\Order;
use App\Models\Item;
use App\Models\Passport;
use App\Models\PassportOrder;
use App\Models\PassportUsedOrder;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Location;
use App\Models\GeneralSetting;
use App\Models\Place;


use Razorpay\Api\Api;
use Session;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use Cart;
use Softon\Indipay\Facades\Indipay;

class CartController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	protected $page;
	public function __construct()
	{
		$this->page = new \stdClass();
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */

	public function setCartData()
	{

		$product_arr = $this->getCartProduct();
		$cart_view = view('cart.header_cart_view', ['product_arr' => $product_arr])->render();
		return response()->json(['success' => 1, 'cart_view' => $cart_view, 'cart_count' => Cart::count(), 'cart_total' => Cart::subtotal()]);
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

	public function addToCart(Request $request)
	{
		// echo '<pre>request - '; print_r($request->all()); die;
		if (isset((auth()->user()->id)) && !empty(auth()->user()->id)) {
			if (!empty(auth()->user()->age)) {
				$age = auth()->user()->age;
			} else {
				$age = session('age');
			}

			// Cart::destroy();
			$pid = $request->id;
			$product = Product::find($pid);
			// echo '<pre>adata - ';print_R($product->toArray());die;
			$product_arrs = $this->getCartProduct();

			$placeArr = array();
			if ($product_arrs) {
				foreach ($product_arrs as $product_arr) {
					$placeArr[] = $product_arr['place_id'];
				}
			}


			if ($product->type == 1 && $age < 21) {
				return response()->json(['success' => 0, 'message' => 'Your age is under 21, so you do not have permission to purchase liquor products.']);
			} else {
				if (empty($placeArr) || in_array($product['place'], $placeArr)) {
					if ($product->file_id != 0) {
						$file_data = DB::table('upload_images')->where('id', $product->file_id)->first();
						$file = asset($file_data->file);
					} else {
						$file = asset('administrator/images/noproduct.png');
					}

					$pid = $request->id;
					$qty = $request->qty;
					$attr_id = !empty($request->attr_id) ? $request->attr_id : 0;
					$attr_name = !empty($request->attr_name) ? $request->attr_name : '';
					$option_id = !empty($request->option_id) ? $request->option_id : $product->option_id;
					$option_name = !empty($request->option_name) ? $request->option_name : '';
					$price = !empty($request->price) ? $request->price : $product->price;
					$tax = !empty($request->tax) ? $request->tax : $product->tax;
					$total_price = !empty($request->total_price) ? $request->total_price : $product->total_price;
			
					$adata = array(
						'id' => $product->id,
						'name' => $product->title,
						'qty' => $qty,
						'place' => $product->place,
						'price' => $price,
						'options' => array('image' => $file, 'place_id' => $product->place, 'product_tax' => $tax, 'product_price' => $price, 'total_price' => $total_price, 'product_type' => $product->type, 'option_name' => $option_name, 'option_id' => $option_id, 'attr_id' => $attr_id, 'attr_name' => $attr_name),
					);
					
					Cart::add($adata);
					$product_arr = $this->getCartProduct();
					// echo '<pre>product_arr - ';print_R($product_arr);die;
					$cart_view = view('cart.header_cart_view', ['product_arr' => $product_arr])->render();
					// echo $cart_view; die;

					$data['cart'] = $this->getCartProduct();
					//echo '<pre>';print_R($data['cart']);die;
					$data['product'] = $product = Product::find($pid);
					$this->addToLocations($request, $product->location);
					$product_view = view('cart.product_cart_view', $data)->render();

					return response()->json(['success' => 1, 'cart_view' => $cart_view, 'pid' => $pid, 'product_view' => $product_view, 'cart_count' => Cart::count(), 'cart_total' => Cart::subtotal(), 'message' => 'Product added in cart', 'location_id' => session('location'), 'location_name' => session('location_name')]);
				} else {
					return response()->json(['success' => 0, 'message' => 'Can not add different restaurants products at that time.']);
				}
			}
		} else {
			return response()->json(['success' => 2, 'message' => 'Please login first.']);
		}
	}


	public function addToLocations($request, $location_id)
	{

		$location = Location::where(['id' => $location_id, 'status' => 1])->first();
		$request->session()->put('location', $location_id);
		$request->session()->put('location_name', $location->name);
		return true;
	}

	public function checkout_total_view(Request $request) {

		$order_type = $request->orderType;

		$this->page->title = 'Checkout';
		$minimum_purchase_amount = GeneralSetting::select('meta_value')->where('meta_key','minimum_purchase_amount')->first();
		$delivery_charges = GeneralSetting::select('meta_value')->where('meta_key','delivery_charges')->first();

	//   echo"<pre>";print_r($minimum_purchase_amount['meta_value']);die;
		$content = Cart::content();
		
		$product_arr = array();
		$i = 0;
		$total = 0;
		foreach ($content as $con) {

			$product_arr[$i]['rowId'] = $con->rowId;
			$product_arr[$i]['id'] = $con->id;
			$product_arr[$i]['name'] = $con->name;
			$product_arr[$i]['qty'] = $con->qty;
			$product_arr[$i]['price'] = number_format((float)$con->price, 2, '.', '');
			$product_arr[$i]['product_tax'] = $con->options->product_tax;
			$product_arr[$i]['product_price'] = $con->options->product_price;
			$product_arr[$i]['total_price'] = $con->options->total_price;
			$product_arr[$i]['image'] = $con->options->image;
			$product_arr[$i]['product_type'] = $con->options->product_type;
			$product_arr[$i]['place_id'] = $con->options->place_id;
			$product_arr[$i]['option_name'] = $con->options->option_name;
			$product_arr[$i]['option_id'] = $con->options->option_id;
			$product_arr[$i]['attr_name'] = $con->options->attr_name;
			$product_arr[$i]['attr_id'] = $con->options->attr_id;
			$total += $con->qty * $con->options->total_price;
			// echo$total;die;

			if($order_type == 0){
				if($total <= $minimum_purchase_amount['meta_value']){ //echo"a";die;
					$finalAmount = $total + $delivery_charges['meta_value'];
					$dCharges = $delivery_charges['meta_value'];
				}else{
					$finalAmount = $total;
					$dCharges = '0.00';
				}
			}else{
					$finalAmount = $total;
					$dCharges = '0.00';
			}	

			$i++;
		}
		//echo '<pre>';print_r(Cart::subtotal());die;
		// echo '<pre>';print_r($total);die;
		$view = view('cart.checkout_total_view', ['page' => $this->page, 'product_arr' => $product_arr, 'total' => $finalAmount,'dCharges' => $dCharges])->render();

		return response()->json(['success' => 1, 'view' => $view]);

	}

	public function checkout()
	{
		// echo"<pre>";print_r($_POST);die;
		 //echo"a";die;
		// $TOTAL =  2396.00 +  119.80;
		
		// echo floor($TOTAL);die;
		/*
		$parameters = [
        'transaction_no' => '1233221223322',
        'amount' => '1200.00',
        'name' => 'Jon Doe',
        'email' => 'jon@doe.com',
		'order_id'=>"123654789"
      ];
      
      $order = Indipay::gateway('CCAvenue')->prepare($parameters);
      return Indipay::process($order);
	  */

		$this->page->title = 'Checkout';
		$minimum_purchase_amount = GeneralSetting::select('meta_value')->where('meta_key','minimum_purchase_amount')->first();
		$delivery_charges = GeneralSetting::select('meta_value')->where('meta_key','delivery_charges')->first();

	//   echo"<pre>";print_r($minimum_purchase_amount['meta_value']);die;
		$content = Cart::content();
		
		$product_arr = array();
		$i = 0;
		$total = 0;
		foreach ($content as $con) {

			$product_arr[$i]['rowId'] = $con->rowId;
			$product_arr[$i]['id'] = $con->id;
			$product_arr[$i]['name'] = $con->name;
			$product_arr[$i]['qty'] = $con->qty;
			$product_arr[$i]['price'] = number_format((float)$con->price, 2, '.', '');
			$product_arr[$i]['product_tax'] = $con->options->product_tax;
			$product_arr[$i]['product_price'] = $con->options->product_price;
			$product_arr[$i]['total_price'] = $con->options->total_price;
			$product_arr[$i]['image'] = $con->options->image;
			$product_arr[$i]['product_type'] = $con->options->product_type;
			$product_arr[$i]['place_id'] = $con->options->place_id;
			$product_arr[$i]['option_name'] = $con->options->option_name;
			$product_arr[$i]['option_id'] = $con->options->option_id;
			$product_arr[$i]['attr_name'] = $con->options->attr_name;
			$product_arr[$i]['attr_id'] = $con->options->attr_id;
			$total += $con->qty * $con->options->total_price;
		
			// echo$total;die;
			if($total <= $minimum_purchase_amount['meta_value']){ //echo"a";die;
				$finalAmount = $total + $delivery_charges['meta_value'];
				$dCharges = $delivery_charges['meta_value'];
			}else{
				$finalAmount = $total;
				$dCharges = '0.00';
			}

			$i++;
			// echo '<pre>';print_r($finalAmount);
		}
		// die;
		// echo '<pre>';print_r(Cart::subtotal());die;
		
		return view('cart.checkout', ['page' => $this->page, 'product_arr' => $product_arr, 'total' => $finalAmount,'dCharges' => $dCharges]);
	}


	public function getCheckoutData()
	{

		$content = Cart::content();

		$product_arr = array();
		$i = 0;
		foreach ($content as $con) {
			$product_arr[$i]['name'] = $con->name;
			$product_arr[$i]['qty'] = $con->qty;
			$product_arr[$i]['price'] = number_format((float)$con->price, 2, '.', '');
			$product_arr[$i]['image'] = $con->options->image;


			$word_ranges = array();
			if ($con->options->word_ranges) {
				$j = 0;
				foreach ($con->options->word_ranges as $word_range) {
					$word_ranges[$j]['word_range_title'] = $word_range->word_range_title;
					$word_ranges[$j]['price'] = $word_range->price;

					$j++;
				}
			}

			$product_arr[$i]['word_ranges'] = $word_ranges;

			$addons = array();
			if ($con->options->addons) {
				$j = 0;
				foreach ($con->options->addons as $addon) {
					$addons[$j]['addon_title'] = $addon->addon_title;
					$addons[$j]['addon_price'] = $addon->addon_price;
					$j++;
				}
			}
			$product_arr[$i]['addons'] = $addons;


			$i++;
		}


		$checkout_view = view('cart.checkout_view', ['product_arr' => $product_arr])->render();

		return response()->json(['success' => 1, 'checkout_view' => $checkout_view, 'cart_count' => Cart::count(), 'cart_total' => Cart::total()]);
	}

	public function removeItem(Request $request)
	{
		$rowId = $request['rowId'];
		Cart::remove($rowId);

		$product_arr = $this->getCartProduct();
		$cart_view = view('cart.header_cart_view', ['product_arr' => $product_arr])->render();

		return response()->json(['success' => 1, 'message' => "Product removed successfully", 'cart_view' => $cart_view, 'cart_count' => Cart::count(), 'cart_total' => Cart::subtotal(), 'cart_sub_total' => Cart::subtotal()]);
	}


	public function changeItem(Request $request)
	{
		$rowId = $request['rowId'];
		$item = Cart::get($rowId);
		$items['rowID'] = $rowId;
		$items['name'] = $item->name;
		$items['price'] = $item->price;

		$option = $item->options;

		$items['product_type'] = $option->product_type;
		$items['pid'] = $option->pid;
		$items['image'] = $option->image;

		$addons = $option->addons;
		$addonid = array();
		foreach ($addons as $addon) {
			$addonid[] = $addon->id;
		}
		$items['addons'] = implode(',', $addonid);
		$items['addons_arr'] = $addonid;


		$questions = $option->questions;
		$questionid = array();
		foreach ($questions as $question) {
			$questionid[] = $question->id;
		}
		$items['questions'] = implode(',', $questionid);

		$items['word_range'] = $option->word_ranges->id;
		$id = $option->pid;
		$product = Product::find($id);

		$file = '';
		if ($product->icon != 0) {
			$file_data = DB::table('upload_images')->where('id', $product->icon)->first();
			$file = asset('images/project/' . $file_data->file);
		} else {
			$file = asset('administrator/images/noproduct.png');
		}



		$price = 0;
		$addons = array();
		$addon_ids = $product->addons;
		if ($addon_ids) {
			$ids = explode(',', $addon_ids);
			$addons = Addon::whereIn('id', $ids)->get();
		}

		$word_ranges = $word_range_data = array();
		$qry = ProductWordRange::where('product_id', $id);
		$qry->join('word_ranges', 'word_ranges.id', '=', 'product_word_ranges.word_range_id');
		$qry->select('word_ranges.word_range_title', 'word_ranges.id', 'product_word_ranges.price');
		$word_ranges = $qry->get();
		$i = 0;
		foreach ($word_ranges as $word_range) {
			if ($i == 1) {
				break;
			}
			$word_range_data['id'] = $word_range->id;
			$word_range_data['price'] = $word_range->price;
			$word_range_data['title'] = $word_range->word_range_title;
			$i++;
		}

		$product_view = view('cart.single_product_detail', ['items' => $items, 'product' => $product, 'addons' => $addons, 'word_ranges' => $word_ranges, 'file' => $file, 'word_range_data' => $word_range_data])->render();

		return response()->json(['success' => 1, 'view' => $product_view]);
	}



	public function updateCart(Request $request)
	{
		$pid = $request->id;
		$product = Product::find($pid);

		if ($product->icon != 0) {
			$file_data = DB::table('upload_images')->where('id', $product->icon)->first();
			$file = asset('images/project/' . $file_data->file);
		} else {
			$file = asset('administrator/images/noproduct.png');
		}

		if ($request->product_type == 0) {
			$pid = $request->id;
			$word_range_id = $request->word_range_id;
			$addons_ids = $request->addons_ids;
			$qty = $request->qty;
			$price = $request->price;



			$word_ranges = $addons = $questions = array();
			$addon_ids = $product->addons;
			if ($addons_ids) {
				$ids = explode(',', $addons_ids);
				$addons = Addon::whereIn('id', $ids)->get();
			}


			if ($word_range_id) {
				$ids = explode(',', $word_range_id);
				$word_ranges = WordRange::where('id', $ids)->first();
			}

			//echo '<pre>';print_R($word_ranges);die;

			$question_ids = $product->questions;
			if ($question_ids) {
				$ids = explode(',', $question_ids);
				$questions = Question::whereIn('id', $ids)->get();
			}

			$price = number_format((float)$price, 2, '.', '');


			$adata = array(
				'id' => time() . rand(),
				'name' => $product->title,
				'qty' => 1,
				'price' => $price,
				'options' => array('product_type' => $request->product_type, 'pid' => $product->id, 'image' => $file, 'addons' => $addons, 'word_ranges' => $word_ranges, 'questions' => $questions),
				'tax' => 0
			);
		} else {
			$adata = array(
				'id' => time() . rand(),
				'name' => $product->title,
				'qty' => 1,
				'price' => $product->total_price,
				'options' => array('product_type' => $request->product_type, 'pid' => $product->id, 'image' => $file),
				'tax' => 0
			);
		}


		Cart::update($request->rowID, $adata);
		$product_arr = $this->getCartProduct();
		$cart_view = view('cart.header_cart_view', ['product_arr' => $product_arr])->render();
		$checkout_view = $this->checkout_view();
		return response()->json(['success' => 1, 'checkout_view' => $checkout_view, 'cart_view' => $cart_view, 'cart_count' => Cart::count(), 'cart_total' => Cart::subtotal(), 'message' => 'Product Cart Updated Successfully']);
	}



	public function checkout_view()
	{

		$content = Cart::content();
		//	echo '<pre>';print_r($content);die;
		$product_arr = array();
		$i = 0;
		foreach ($content as $con) {

			$product_arr[$i]['rowId'] = $con->rowId;
			$product_arr[$i]['id'] = $con->id;
			$product_arr[$i]['name'] = $con->name;
			$product_arr[$i]['qty'] = $con->qty;
			$product_arr[$i]['price'] = number_format((float)$con->price, 2, '.', '');
			$product_arr[$i]['image'] = $con->options->image;


			$word_ranges = array();
			if ($con->options->word_ranges) {
				$qry = ProductWordRange::where('product_id', $con->options->pid)->where('product_word_ranges.word_range_id', $con->options->word_ranges->id);
				$qry->join('word_ranges', 'word_ranges.id', '=', 'product_word_ranges.word_range_id');
				$qry->select('word_ranges.word_range_title', 'word_ranges.id', 'product_word_ranges.price');
				$productWordRanges = $qry->first();
				$word_ranges['word_range_title'] = $productWordRanges->word_range_title;
				$word_ranges['price'] = $productWordRanges->price;
			}

			$product_arr[$i]['word_ranges'] = $word_ranges;

			$addons = array();
			if ($con->options->addons) {
				$j = 0;
				foreach ($con->options->addons as $addon) {
					$addons[$j]['addon_title'] = $addon->addon_title;
					$addons[$j]['addon_price'] = $addon->addon_price;
					$j++;
				}
			}
			$product_arr[$i]['addons'] = $addons;


			$i++;
		}

		return view('cart.checkout_view', ['page' => $this->page, 'product_arr' => $product_arr])->render();
	}


	public function cartProcess(Request $request)
	{
		if($request->order_for == 1){
			return $this->cartProcessTakewayOrder($request);
			//  true;
		}
		if ($request->new_address == 1) {
			$validator = Validator::make(
				$request->all(),
				[
					'consumer_name' => 'required',
					'phone'  		=> 'required|digits:10|',
					'address'  		=> 'required',
					'city'  		=> 'required',
					'state'  		=> 'required',
					'order_for'  		=> 'required',
					'pincode'  		=> 'required',
				]
			);

			if ($validator->fails()) {
				return $validator->validate();
			}
		}

		$user = User::where('id', Auth::user()->id)->first();
		if ($user) {
			if ($user['name'] == '') {
				User::where('id', Auth::user()->id)->update(['name' => $request->consumer_name]);
			}
		}


		$getLocation = session('location');
		if (Cart::count() > 0) {
			$content = Cart::content();
			$productArrs = $this->getCartProduct();
			$passport_code = $coupon_code = '';
			$passport_pay = $coupon_percent = $coupon_amount = 0;



			$codeAmt = 0;
			$type = 1;
			if ($request->codeAmt) {
				$codeAmt = str_replace(',', '', $request->codeAmt);
			}
			if ($request->codeType == 'coupon') {
				$coupon = Coupon::where('discount_code', $request->codeNum)->first();
				$coupon_code = $request->codeNum;
				$coupon_percent = $coupon->discount;
				$coupon_amount = $codeAmt;
				$type = 4;
			}

			if ($request->codeType == 'passport') {
				$passport_code = $request->codeNum;
				$passport_pay = $codeAmt;
				$type = 2;
			}



			$content = Cart::content();

			$total = 0;
			$p_price = 0;
			$counter = 0;
			$first_item_id = 0;
			foreach ($content as $con) {
				$total += $con->qty * $con->options->total_price;
				$p_price += $con->qty * $con->options->product_price;
				if ($counter == 0) {
					$first_item_id = $con->id;
				}
				$counter++;
			}
			$total_pay = $total - $codeAmt;


			if ($request->new_address == 1) {
				$addresspart = Home_address::create([
					'user_id' => Auth::user()->id,
					'title' => $request->address_type,
					'city' => $request->city,
					'pincode' => $request->pincode,
					'phone' => Auth::user()->phone,
					'address' => $request->address,
					'state' => $request->state,
					'status' => 1,
				]);
				$address_id = $addresspart->id;
			} else {
				$address_id = $request->radio;
			}
			$homeAddress = Home_address::where('user_id', Auth::user()->id)->where('id', $address_id)->first();

			$order = Order::create([
				'user_id' => Auth::user()->id,
				'place_id' => $productArrs[$first_item_id]['place_id'],
				'location' => $getLocation,
				'name' => $request->consumer_name,
				'phone' => Auth::user()->phone,
				'address' => $homeAddress->address,
				'state' => $homeAddress->state,
				'city' => $homeAddress->city,
				'pincode' => $homeAddress->pincode,
				'order_for' => $request->order_for,
				'qty' => Cart::count(),
				'sub_total' => str_replace(',', '', Cart::subtotal()),
				'total' => str_replace(',', '', $total),
				'total_pay' => str_replace(',', '', $total_pay),
				'passport_code' => $passport_code,
				'passport_pay' => $passport_pay,
				'type' => $type,
				'coupon_code' => $coupon_code,
				'coupon_percent' => $coupon_percent,
				'coupon_amount' => $coupon_amount,
				'status' => 0,
				'order_status' => 0,
				'order_date' => date('Y-m-d')
			]);



			$data['location'] = $loc = Location::where('status', 1)->where('id', $getLocation)->first();
			$loctions = explode(',', $loc->allow_pincode);

			// echo "<pre>";
			// print_r($loctions);
			// die;
			if (!empty($request->pincode_id_data)) {

				if (in_array($request->pincode_id_data, $loctions)) {

					$oid = $order->id;

					$product_arr = array();
					$i = 0;
					foreach ($content as $con) {

						$product_arr[$i]['row_id'] = $con->rowId;
						$product_arr[$i]['id'] = $con->id;
						$product_arr[$i]['name'] = $con->name;
						$product_arr[$i]['qty'] = $con->qty;
						$product_arr[$i]['price'] = number_format($con->price, 2);
						$product_arr[$i]['image'] = $con->options->image;
						$product_arr[$i]['place_id'] = $con->options->place_id;
						$product_arr[$i]['tax'] = $con->tax;
						$product_arr[$i]['subtotal'] = $con->subtotal;

						Item::create([
							'user_id' => Auth::user()->id,
							'order_id' => $order->id,
							'product_id' => $con->id,
							'qty' => $con->qty,
							'price' => $con->options->total_price,
							'sub_total' => $con->options->total_price * $con->qty,
							'attr_id' => $con->options['attr_id'],
							'attr_name' => $con->options['attr_name'],
							'option_id' => $con->options['option_id'],
							'option_name' => $con->options['option_name'],
						]);

						$i++;
					}
					return response()->json(['success' => 1, 'message' => "Payment Process, Please Wait..,", 'id' => $oid]);
				} else {
					return response()->json(['success' => 0, 'message' => "Over Location Is not able to shipping order on your pincode location"]);
				}

			} else {
				if (in_array($request->pincode, $loctions)) {

					$oid = $order->id;

					$product_arr = array();
					$i = 0;
					foreach ($content as $con) {

						$product_arr[$i]['row_id'] = $con->rowId;
						$product_arr[$i]['id'] = $con->id;
						$product_arr[$i]['name'] = $con->name;
						$product_arr[$i]['qty'] = $con->qty;
						$product_arr[$i]['price'] = number_format($con->price, 2);
						$product_arr[$i]['image'] = $con->options->image;
						$product_arr[$i]['place_id'] = $con->options->place_id;
						$product_arr[$i]['tax'] = $con->tax;
						$product_arr[$i]['subtotal'] = $con->subtotal;

						Item::create([
							'user_id' => Auth::user()->id,
							'order_id' => $order->id,
							'product_id' => $con->id,
							'qty' => $con->qty,
							'price' => $con->options->total_price,
							'sub_total' => $con->options->total_price * $con->qty,
							'attr_id' => $con->options['attr_id'],
							'attr_name' => $con->options['attr_name'],
							'option_id' => $con->options['option_id'],
							'option_name' => $con->options['option_name'],
						]);

						$i++;
					}
					return response()->json(['success' => 1, 'message' => "Payment Process, Please Wait..,", 'id' => $oid]);
				} else {
					return response()->json(['success' => 0, 'message' => "Over Location Is not able to shipping order on your pincode location"]);
				}
			}
		} else {
			return response()->json(['success' => 0, 'message' => "Cart empty"]);
		}
	}


	public function cartProcessTakewayOrder(Request $request){

		$validator = Validator::make(
			$request->all(),
			[
				'consumer_name' => 'required',
				'phone'  		=> 'required|digits:10|',
			]
		);

		if ($validator->fails()) {
			return $validator->validate();
		}

		$user = User::where('id', Auth::user()->id)->first();
		if ($user) {
			if ($user['name'] == '') {
				User::where('id', Auth::user()->id)->update(['name' => $request->consumer_name]);
			}
		}


		$getLocation = session('location');
		if (Cart::count() > 0) {
			$content = Cart::content();
			$productArrs = $this->getCartProduct();
			$passport_code = $coupon_code = '';
			$passport_pay = $coupon_percent = $coupon_amount = 0;



			$codeAmt = 0;
			$type = 1;
			if ($request->codeAmt) {
				$codeAmt = str_replace(',', '', $request->codeAmt);
			}
			if ($request->codeType == 'coupon') {
				$coupon = Coupon::where('discount_code', $request->codeNum)->first();
				$coupon_code = $request->codeNum;
				$coupon_percent = $coupon->discount;
				$coupon_amount = $codeAmt;
				$type = 4;
			}

			if ($request->codeType == 'passport') {
				$passport_code = $request->codeNum;
				$passport_pay = $codeAmt;
				$type = 2;
			}



			$content = Cart::content();

			$total = 0;
			$p_price = 0;
			$counter = 0;
			$first_item_id = 0;
			foreach ($content as $con) {
				$total += $con->qty * $con->options->total_price;
				$p_price += $con->qty * $con->options->product_price;
				if ($counter == 0) {
					$first_item_id = $con->id;
				}
				$counter++;
			}
			$total_pay = $total - $codeAmt;


			$order = Order::create([
				'user_id' => Auth::user()->id,
				'place_id' => $productArrs[$first_item_id]['place_id'],
				'location' => $getLocation,
				'name' => $request->consumer_name,
				'phone' => Auth::user()->phone,
				'order_for' => $request->order_for,
				'qty' => Cart::count(),
				'sub_total' => str_replace(',', '', Cart::subtotal()),
				'total' => str_replace(',', '', $total),
				'total_pay' => str_replace(',', '', $total_pay),
				'passport_code' => $passport_code,
				'passport_pay' => $passport_pay,
				'type' => $type,
				'coupon_code' => $coupon_code,
				'coupon_percent' => $coupon_percent,
				'coupon_amount' => $coupon_amount,
				'status' => 0,
				'order_status' => 0,
				'order_date' => date('Y-m-d')
			]);


				$oid = $order->id;

					$product_arr = array();
					$i = 0;
					foreach ($content as $con) {

						$product_arr[$i]['row_id'] = $con->rowId;
						$product_arr[$i]['id'] = $con->id;
						$product_arr[$i]['name'] = $con->name;
						$product_arr[$i]['qty'] = $con->qty;
						$product_arr[$i]['price'] = number_format($con->price, 2);
						$product_arr[$i]['image'] = $con->options->image;
						$product_arr[$i]['place_id'] = $con->options->place_id;
						$product_arr[$i]['tax'] = $con->tax;
						$product_arr[$i]['subtotal'] = $con->subtotal;

						Item::create([
							'user_id' => Auth::user()->id,
							'order_id' => $order->id,
							'product_id' => $con->id,
							'qty' => $con->qty,
							'price' => $con->options->total_price,
							'sub_total' => $con->options->total_price * $con->qty,
							'attr_id' => $con->options['attr_id'],
							'attr_name' => $con->options['attr_name'],
							'option_id' => $con->options['option_id'],
							'option_name' => $con->options['option_name'],
						]);

						$i++;
					}
					return response()->json(['success' => 1, 'message' => "Payment Process, Please Wait..,", 'id' => $oid]);
		}
	}

	public function changeCartQuantity(Request $request)
	{

		// echo '<pre>request - ';print_r($request->all());die;

		$row_id = $request->id;
		$adata = array(
			'qty' => $request->qty,
		);

		Cart::update($row_id, $adata);
		return response()->json(['success' => 1, 'message' => 'Cart Quantity Updated Successfully']);
	}

	public function cart_checkout_view(Request $request)
	{
		//echo '<pre>request - '; print_r($request->all()); die;
		$homeAddress = Home_address::where('user_id', Auth::user()->id)->get();
		$CurrentLocation = Location::where('id', session('location'))->first();
		$loctions = explode(',', $CurrentLocation->allow_pincode);
		//    echo '<pre>request - '; print_r($homeAddress->toArray()); die;
		$view = view('cart/checkout_view', ['amt' => $request->amt, 'codeType' => $request->codeType, 'homeAddress' => $homeAddress, 'codeNum' => $request->codeNum, 'codeAmt' => $request->codeAmt, 'Location' => $loctions,'order_for'=>$request->order_for]);
		return response()->json(['status' => 1, 'view' => $view->render()]);
	}

	public function payment_submit(Request $request)
	{
		// echo '<pre>request - '; print_r($request->all()); die;
		if (!empty($request->pay_method == 'direct_payment')) {
			$order_data = array(
				'payment_id' => 'pay_' . str_shuffle("FRENCHBREWW") . rand(10, 999),
				'payment_date' => date('Y-m-d'),
				'pay_status' => $request->status,
				'pay_res' => '',
				'status' => 1,
			);
		} else {


			$api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

			$payment = $api->payment->fetch($request->pay_id);
			$payment_arr = $payment->toArray();
			//echo '<pre>pay_data - '; var_dump($payment_arr); die;
			$payment_capture = $api->payment->fetch($payment_arr['id'])->capture(array('amount' => $payment_arr['amount'], 'currency' => 'INR'));

			$order_data = array(
				'payment_id' => $request->pay_id,
				'payment_date' => date('Y-m-d'),
				'pay_status' => $request->status,
				'pay_res' => json_encode($payment_arr),
				'status' => 1,
			);
		}

		//echo '<pre>pay_data - '; print_r($order_data); die;
		//echo '<pre>pay_data - '; print_r($payment_arr['amount']); die;
		Order::where(['id' => $request->id])->update($order_data);

		$check_order = Order::where(['id' => $request->id])->first();

		if (!empty($check_order->passport_code)) {
			$passport_code = $check_order->passport_code;
			$passport_pay = $check_order->passport_pay;
			//$total_payment = $check_order->totat_pay * 100;



			$passportOrder = PassportOrder::where('passport_code', $passport_code)->first();

			$remaining_amount = $passportOrder->remaining_amount - $passport_pay;
			$used_amount = $passportOrder->used_amount + $passport_pay;

			if ($passportOrder->remaining_amount > 0) {
				PassportOrder::where('passport_code', $passport_code)->update(array('used_amount' => $used_amount, 'remaining_amount' => $remaining_amount));

				PassportUsedOrder::create([
					'user_id' => Auth::user()->id,
					'order_id' => $request->id,
					'passport_code' => $passport_code,
					'order_type' => 1,
					'amount' => $passport_pay,
					'order_date' => time()
				]);
			}
		}
		$place_data = Place::where('id',$check_order->place_id)->first();	
		$user_data = User::where('id',Auth::user()->id)->first();
		$phone = $user_data->phone;  
		$place_name = $place_data->name;
		if ($request->status == 1) {
			Cart::destroy();
			sendNotification('Order Send','Your Order has been requested at the Restaurant '.$place_name.'','','user_'.$phone.'');
			return response()->json(['status' => 1, 'msg' => 'Payment Success', 'id' => $request->id]);
		} elseif ($request->status == 2) {
			return response()->json(['status' => 2, 'msg' => 'Payment Failed', 'id' => $request->id]);
		}
	}



	public function updateQty(Request $request)
	{
		$pid = $request->pid;
		$type = $request->type;
		$row_id = $request->row_id;
		$item = Cart::get($row_id);

		$qty = $item->qty;
		if ($type == 0) {
			$qty--;
		} else {
			$qty++;
		}
		$adata = array('qty' => $qty);
		Cart::update($row_id, $adata);

		$data['cart'] = $this->getCartProduct();
		$data['product'] = Product::find($pid);

		$cart_view = view('cart.product_cart_view', $data)->render();
		return response()->json(['status' => 1, 'qty' => $qty, 'cart_count' => Cart::count(), 'cart_total' => Cart::subtotal(), 'cart_view' => $cart_view, 'msg' => 'Quantity Update Successfully',]);
	}
}
