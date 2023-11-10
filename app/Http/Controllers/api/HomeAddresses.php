<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Home_address;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class HomeAddresses extends Controller
{

    public function saveUseraddress(Request $request)
    {

        if ($user = JWTAuth::parseToken()->authenticate()) {   //echo"a";die;


            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'city' => 'required',
                'phone' => 'required',
                'state' => 'required',
                'address' => 'required',
                'pincode' => 'required',
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }



            $order = Home_address::create([
                'user_id' => auth()->user()->id,
                'title' => $request->title,
                'city' => $request->city,
                'phone' => $request->phone,
                'state' => $request->state,
                'address' => $request->address,
                'pincode' => $request->pincode,
                'status' => 1,
            ]);


            return response()->json([
                'success' => true,
                'message' => 'New Address Added',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }

    public function getUserAddress(Request $request)
    {

        if ($user = JWTAuth::parseToken()->authenticate()) {   //echo"a";die;


            $getData = Home_address::where('user_id', auth()->user()->id)->get();

            return response()->json([
                'success' => true,
                'message' => 'All User Address',
                'data' =>  $getData
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }

    public function getsingleAddress(Request $request)
    {

        if ($user = JWTAuth::parseToken()->authenticate()) {   //echo"a";die;


            $getData = Home_address::where(['user_id' => $request->user_id, 'id' => $request->id])->get();
            //  echo"<pre>";print_r($getData->toArray());die;
            if (!empty($getData->toArray())) { //echo"a";die;

                return response()->json([
                    'success' => true,
                    'message' => 'Single User Address',
                    'data' =>  $getData
                ], Response::HTTP_OK);
            } else { //echo"b";die;
                return response()->json([
                    'success' => false,
                    'message' => 'No Data Available',
                ], 400);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'invalid User.',
            ], 400);
        }
    }

    public function deletesingleAddress(Request $request)
    {
        $getData = Home_address::where(['user_id' => $request->user_id, 'id' => $request->id])->first();
        $id = $request->id;
        $user_id = $request->user_id;

        $user = Home_address::where('id', $id)->where('user_id', $user_id);
        $user->delete();

        if (empty($getData)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Id Or userid',
            ], 400);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'User address deleted Successfully',
                'data' =>  [],
            ], Response::HTTP_OK);
        }
    }
}
