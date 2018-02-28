<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Event;
require(__DIR__ . '/maps.php');

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request()->all());

        $key = 'AIzaSyDyyd0zM6OUe4PflYQ1_BD-feq3omU9zK0';

        $search = implode(', ', [$request['address'], $request['number'], $request['zip']]);

        $geoData = google_maps_search($search, $key);

        $mapData = map_google_search_result($geoData);

        Event::create([
            'provider_id' => $request->user('provider')->id,
            'title' => request('title'),
            'date' => request('date'),
            'price' => request('price') ,
            'description' => request('description') ,
            'ages' => request('ages'),
            'category' => request('category'),
            'availability' => request('availability'),
            'city' => request('city'),
            'address' => request('address'),
            'number' => request('number'),
            'zip' => request('zip'),
            'lat' => $mapData['lat'], 
            'long' => $mapData['lng'],
        ]);

        return redirect('/events');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('events.edit')
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
}
