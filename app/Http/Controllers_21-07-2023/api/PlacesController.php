<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;


class PlacesController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $place_arr = array();
        $p = Place::where('status', 1);
        if ($request->location) {
            $p->where('location', $request->location);
        }
        $places = $p->get();
        $i = 0;
        foreach ($places as $place) {
            if (empty($place->LogoId->file)) {
                $logo_image = asset($place->FileId->file);
            } else {
                $logo_image = asset($place->LogoId->file);
            }
            $place_arr[$i] = $place;
            $place_arr[$i]['location_name'] = $place->Location->name;
            $place_arr[$i]['is_home_menu'] = $place->Location->is_home_menu;
            $place_arr[$i]['in_add_cart'] = $place->Location->in_add_cart;
            $place_arr[$i]['image'] = asset($place->FileId->file);
            $place_arr[$i]['icon'] = asset($place->IconId->file);
            $place_arr[$i]['logo_image'] = $logo_image;
            $place_arr[$i]['images'] = get_place_image_explode($place->file_ids);
            unset($place_arr[$i]['created_at']);
            unset($place_arr[$i]['updated_at']);
            unset($place_arr[$i]['status']);
            $i++;
        }
        return response()->json([
            'success' => true,
            'message' => 'Places list',
            'data' => $place_arr
        ], Response::HTTP_OK);
    }


    public function show($id)
    {
        $place_arr = array();
        $place = Place::find($id);

        if (empty($place->LogoId->file)) {
            $logo_image = asset($place->FileId->file);
        } else {
            $logo_image = asset($place->LogoId->file);
        }

        $place_arr = $place;
        $place_arr['location_name'] = $place->Location->name;
        $place_arr['image'] = asset($place->FileId->file);
        $place_arr['icon'] = asset($place->IconId->file);
        $place_arr['logo_image'] = $logo_image;
        $place_arr['images'] = get_place_image_explode($place->file_ids);
        unset($place_arr['created_at']);
        unset($place_arr['updated_at']);
        unset($place_arr['status']);

        return response()->json([
            'success' => true,
            'message' => $place->name . ' Place Detail',
            'data' => $place_arr
        ], Response::HTTP_OK);
    }
}
