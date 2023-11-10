<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class BannersController extends Controller
{
    public function index(Request $request)
    {
    	$banner_arr =array();
        $banners = Banner::select('id','name','file_id')->where('status',1)->get();

        $i=0;
        foreach($banners as $banner){
            $banner_arr[$i]=$banner; 
            $banner_arr[$i]['image']=asset($banner->FileId->file); 
        $i++;
        }
        return response()->json([
            'success' => true,
            'message' => 'Home page banner list',
            'data' => $banner_arr
        ], Response::HTTP_OK);
    }
 
}