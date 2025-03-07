<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    public function getStatesByCountryId(Request $request)
    {
        // México = 142
        // 2438 = Guanajuato
        $states = State::where('country_id', intval($request->country))
            ->orderBy('name', 'ASC')->get(['_id','id', 'name']);
        $result = $states != '[]' ? $states : 'no_data';
        return $result;
    }
}
