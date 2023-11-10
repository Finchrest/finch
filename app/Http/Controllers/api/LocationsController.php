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
        $location_arr = array();

        $l = Location::select('id', 'name', 'file_id', 'is_home_menu', 'in_add_cart', 'is_passport', 'file_id_logo')->where('status', 1);
        if ($request->search) {
            $l->where('name', 'like', '%' . $request->search . '%');
        }
        $locations = $l->get();

        $i = 0;
        foreach ($locations as $location) {
            if (empty($location->LogoId->file)) {
                $logo_image = asset($location->FileId->file);
            } else {
                $logo_image = asset($location->LogoId->file);
            }
            $location_arr[$i] = $location;
            $location_arr[$i]['image'] = asset($location->FileId->file);
            $location_arr[$i]['logo_image'] = $logo_image;
            $i++;
        }
        return response()->json([
            'success' => true,
            'message' => 'Locations list',
            'data' => $location_arr
        ], Response::HTTP_OK);
    }
}
