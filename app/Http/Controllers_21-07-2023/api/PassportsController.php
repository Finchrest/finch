<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PassportPage;
use App\Models\Passport;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;


class PassportsController extends Controller
{
    public function index(Request $request)
    {
        $pass = PassportPage::all();
        $pass_arr=array();
        foreach($pass as $v){
            $pass_arr[$v->slug]=$v;
        
        }
        return response()->json([
            'success' => true,
            'message' => 'Bear Passport',
            'data' => $pass_arr
        ], Response::HTTP_OK);
    }


    public function get_passport_data(Request $request)
    {
        $validator =Validator::make($request->all(), [
            'location' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        $p = Passport::select('id','passport_id','name','sub_description','description','file_id','sub_total','tax','price');
        $p->where('location',$request->location);
        $p->orderBy('id', 'DESC');
        $passes = $p->get();
        $passnew = array();

       if(!$passes){ 
		   
            return response()->json([
                    'success' => false,
                    'message' => 'Not Available.',
                ], 400);
        }else{
            foreach ($passes as $pass){
			$pass->image=asset($pass->FileId->file); 
            $passnew[] = $pass;
            }
        return response()->json([
            'success' => true,
            'message' => 'Passport data',
            'data' => $passnew
        ], Response::HTTP_OK);
        }
    }


}