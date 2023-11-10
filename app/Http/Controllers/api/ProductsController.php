<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Helper;


class ProductsController extends Controller
{
    
    public function index(Request $request)
    { 
  
        $validator =Validator::make($request->all(), [
            'type' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

    	$product_arr =array();
        $p = Product::select('products.*','places.location');
        $p->join('places', 'places.id', '=', 'products.place');
        $p->where('products.status',1)->where('products.type',$request->type);
        

        if($request->place){
            $p->where('products.place',$request->place);
        }

        if($request->location){
            $p->where('places.location',$request->location);
        }

        $products = $p->get();

        $i=0;
        foreach($products as $product){
            $product_arr[$i]=$product; 
			$product_arr[$i]['title']=strtoupper($product->title);
			$product_arr[$i]['description']=ucwords(strtolower($product->description));
			$product_arr[$i]['short_description']=ucwords(strtolower($product->short_description));
            $product_arr[$i]['image']=asset($product->FileId->file); 
            $product_arr[$i]['type_name']=$product->Type->name; 
            $product_arr[$i]['category_name']=$product->Category->name; 
            $product_arr[$i]['place_name']=$product->Place->name; 
            $product_arr[$i]['location_name']=$product->Place->Location->name; 
			$product_arr[$i]['in_add_cart']=$product->Place->Location->in_add_cart; 
			//$product_arr[$i]['total_price']= empty($product->price)?$product->total_price : $product->price;

            if($product->type ==1){
                $product_arr[$i]['malts']=get_malt_explode($product->malt); 
                $product_arr[$i]['hops']=get_hop_explode($product->hops); 
            }else{
                unset($product_arr[$i]['hops']);
                unset($product_arr[$i]['malt']);
                unset($product_arr[$i]['quantity']);
                unset($product_arr[$i]['percentage']);
                unset($product_arr[$i]['color']);
                unset($product_arr[$i]['orignal_gravity']);
                unset($product_arr[$i]['style']);
            }
            
            unset($product_arr[$i]['created_at']);
            unset($product_arr[$i]['updated_at']);
            unset($product_arr[$i]['status']);
            
        $i++;
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Products list',
            'data' => $product_arr
        ], Response::HTTP_OK);
    }


    public function show($id)
    {
    
    	$product_arr =array();
        $product = Product::find($id);

        $product_arr=$product; 
        $product_arr['image']=asset($product->FileId->file); 
        $product_arr['type_name']=$product->Type->name; 
        $product_arr['category_name']=$product->Category->name; 
        $product_arr['place_name']=$product->Place->name; 
        $product_arr['location_name']=$product->Place->Location->name; 
       
         if($product->type ==1){
                $product_arr['malts']=get_malt_explode($product->malt); 
                $product_arr['hops']=get_hop_explode($product->hops); 
            }else{
                unset($product_arr['hops']);
                unset($product_arr['malt']);
                unset($product_arr['quantity']);
                unset($product_arr['percentage']);
                unset($product_arr['color']);
                unset($product_arr['orignal_gravity']);
                unset($product_arr['style']);
            }

        unset($product_arr['created_at']);
        unset($product_arr['updated_at']);
        unset($product_arr['status']);
        

        return response()->json([
            'success' => true,
            'message' => $product->title.' Product Detail',
            'data' => $product_arr
        ], Response::HTTP_OK);
    }


    public function home_products(Request $request)
    {
		$validator =Validator::make($request->all(), [
            'location' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
    	$product_arr =array();
		if($request->location == 2){
        $products = Product::where('status',1)->where('location',$request->location)->where('type',1)->get();

        $i=0;
        foreach($products as $product){
            $product_arr[$i]=$product; 
            $product_arr[$i]['image']=asset($product->FileId->file); 
            $product_arr[$i]['type_name']=$product->Type->name; 
            $product_arr[$i]['category_name']=$product->Category->name; 
            $product_arr[$i]['malts']=get_malt_explode($product->malt); 
            $product_arr[$i]['hops']=get_hop_explode($product->hops); 
            unset($product_arr[$i]['created_at']);
            unset($product_arr[$i]['updated_at']);
            unset($product_arr[$i]['status']);
            unset($product_arr[$i]['malt']);
        $i++;
        }
		}
        return response()->json([
            'success' => true,
            'message' => 'Home Products list',
            'data' => $product_arr
        ], Response::HTTP_OK);
    }
 
}