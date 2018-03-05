<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HumanController extends Controller
{
    //

    public function addPoints(Request $request){
        $my_points = Auth::guard('human')->user()->points;
        if ($request -> ajax()){
            $new_points= $my_points + $request->points;
            Auth::guard('human')->user()->update(['points' => $new_points]);
            $new= Auth::guard('human')->user()->points;
            return response()->json($new);
        }
    }
}
