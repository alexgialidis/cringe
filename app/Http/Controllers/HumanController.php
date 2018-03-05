<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HumanController extends Controller
{
    //

    public function addPoints(Request $request){
        $my_points = Auth::guard('human')->user()->points;
        $my_id = Auth::guard('human')->user()->id;

        if ($request -> ajax()){
            $new = $my_points + $request->points;
            //Auth::guard('human')->user()->update(['points' => $new_points]);
            DB::beginTransaction();

            try {
                DB::table('humans')->where('id', $my_id)->increment('points', $request->points);
                DB::commit();

            } catch (\Exception $e){
                $new = $my_points;
                DB::rollback();
            }
            //$new= Auth::guard('human')->user()->points;

            return response()->json($new);
        }
    }

    public function history()
    {
        $my_id = Auth::guard('human')->user()->id;
        $tickets = DB::table('tickets')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->where('human_id', $my_id)
                    ->select('event_id','title','date','price', DB::raw('count(*) as total'))
                    ->groupBy('event_id')
                    ->orderBy('events.date','desc')
                    ->get();
        $tickets = json_decode($tickets, true);
        // dd($tickets);
        return view('/human/history', compact('tickets'));

    }
}
