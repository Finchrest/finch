<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class LocationsController extends Controller
{
    public function index(Request $request)
    {
    	$location_arr =array();
        
        $l = Location::select('id','name','file_id')->where('status',1);
        if($request->search){
            $l->where('name', 'like', '%' . $request->search . '%');
        }
        $locations =$l->get();

        $i=0;
        foreach($locations as $location){
            $location_arr[$i]=$location; 
            $location_arr[$i]['image']=asset($location->FileId->file); 
        $i++;
        }
        return response()->json([
            'success' => true,
            'message' => 'Locations list',
            'data' => $location_arr
        ], Response::HTTP_OK);
    }
 
}