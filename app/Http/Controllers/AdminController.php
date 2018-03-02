<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Human;
use App\Provider;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function viewdataH(Request $request){
         if ($request -> ajax()){
            $events= Human::all();
            return response()->json($events);
        }
    }
    public function viewdataP(Request $request){
         if ($request -> ajax()){
            $events= Provider::all();
            return response()->json($events);
        }
    }
    public function deleteProvider(Request $request){
         if ($request -> ajax()){
            Provider::where('id', $request->id)->delete();
            return response()->json("aa");
        }
    }
    public function deleteHuman(Request $request){
         if ($request -> ajax()){
            Human::where('id', $request->id)->delete();
            return response()->json("aa");
        }
    }

    public function lockHuman(Request $request){
        if ($request -> ajax()){
            $humans= Human::where('id', $request->id)->get();
            if ($humans[0]->lock==0){
                Human::where('id', $request->id)->update(['lock' => 1]);
                $new= Human::where('id', $request->id)->get();
                return response()->json($new);

            }else{
                Human::where('id', $request->id)->update(['lock' => 0]);
                $new= Human::where('id', $request->id)->get();
                return response()->json($new);
            }
       }
    }

    public function lockProvider(Request $request){
        if ($request -> ajax()){
            $humans= Provider::where('id', $request->id)->get();
            if ($humans[0]->lock==0){
                Provider::where('id', $request->id)->update(['lock' => 1]);
                $new= Provider::where('id', $request->id)->get();
                return response()->json($new);

            }else{
                Provider::where('id', $request->id)->update(['lock' => 0]);
                $new= Provider::where('id', $request->id)->get();
                return response()->json($new);
            }
       }
    }
}
