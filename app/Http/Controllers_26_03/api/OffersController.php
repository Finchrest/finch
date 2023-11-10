<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class OffersController extends Controller
{
    public function index(Request $request)
    {
		$validator =Validator::make($request->all(), [
            'location' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
		
		$p = Offer::where('status',1);
        if($request->location){
            $p->whereRaw("find_in_set('$request->location',locations) > 0");
        }
        $offers = $p->get();
		
        $i=0;
        foreach($offers as $offer){
            $offer_arr[$i]=$offer; 
            $offer_arr[$i]['image']=asset($offer->FileId->file); 
            unset($offer_arr[$i]['created_at']);
            unset($offer_arr[$i]['updated_at']);
            unset($offer_arr[$i]['status']);
        $i++;
        }
        return response()->json([
            'success' => true,
            'message' => 'Offers list',
            'data' => $offer_arr
        ], Response::HTTP_OK);
    }
 
}