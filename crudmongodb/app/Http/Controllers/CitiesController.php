<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function getCitiesByStateId(Request $request)
    {
        // 2438 = Guanajuato
        // 27849 = León
        $cities = City::where('state_id',intval($request->state))
            ->orderBy('name','ASC')->get(['id','name']);
        $result = $cities != '[]' ? $cities:'no_data';
        return $result; 
    }
}
