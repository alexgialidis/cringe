<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App;
use \App\Mail\Ticket;
use Mail;
use DB;
use \Exception;

use TomLingham\Searchy\Facades\Searchy;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


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

    public function search(Request $request)
    {

        if (request('max_price') == NULL) {
            $max_price = 100000000;
        }

        else {
            $max_price = request('max_price');
        }
        // $events = Searchy::events('title', 'description','category')->query(request('search'))->get();

        if (request('age') == NULL) {
            $events = Event::hydrate((array)Searchy::driver('simple')
                ->events('title', 'description','category')
                ->query(request('search'))
                ->get()
                ->where(
                    'price', '<=', $max_price
                )
                ->toArray());
        }

        else
        {
            $events = Event::hydrate((array)Searchy::driver('simple')
                ->events('title', 'description','category')
                ->query(request('search'))
                ->get()
                ->where('max_age', '>=', request('age'))
                ->where('min_age', '<=', request('age'))
                ->where('price', '<=', $max_price)
                ->toArray());
        }

        $location = request('location');
        $radius = request('radius');

        return view('events.index', compact('events', 'radius', 'location'));
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


        $ints = array_map('intval', explode('-', request('ages')));

        Event::create([
            'provider_id' => $request->user('provider')->id,
            'title' => request('title'),
            'date' => request('date'),
            'price' => request('price') ,
            'description' => request('description') ,
            'min_age' => $ints[0],
            'max_age' => $ints[1],
            'category' => request('category'),
            'availability' => request('availability'),
            'sold' => 0,
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

    public function stats()
    {
        $my_id = Auth::guard('provider')->user()->id;
        $events = Event::where('provider_id', $my_id)->get();
        return view('events.stats', compact('events'));
    }

    public function readData(Request $request){
        $my_id = Auth::guard('provider')->user()->id;
        if ($request -> ajax()){
            $events= Event::where([['provider_id', $my_id],['date', '>=' , $request->start],['date', '<' ,  $request->end]])->get();
            return response()->json($events);
        }

         //$msg = "This is a simple message.";
         //$events = Event::orderBy('date')->get();
         //return response()->json($events);
    }

    public function buy(Event $event)
    {
        if (Auth::guard('human')->user()->lock) {
            return view('events.show', compact('event'));
        }

        else{
            $data = [
                'name' => Auth::guard('human')->user()->name,
                'event' => $event,
                'qr' => QrCode::size(100)->color(255,0,255)->generate('Make me into a QrCode!'),
            ];

            //dd($data);



            DB::beginTransaction();

            try {
                if ($event->availability <= 0)
                    throw new Exception("No available Tickets");
                elseif (Auth::guard('human')->user()->points - $event->price < 0)
                    throw new Exception("Not Enough Points");
                DB::table('events')->where('id', $event->id)->decrement('availability');
                DB::table('events')->where('id', $event->id)->increment('sold');
                DB::table('humans')->where('id', Auth::guard('human')->user()->id)->decrement('points', $event->price);
                
                DB::commit();

            } catch (\Exception $e){
                DB::rollback();
                return view('error', ['string' => $e->getMessage()]);
            }



            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('pdf.invoice', $data);

            $pdf->stream();

            $email = Auth::guard('human')->user()->email;

            Mail::send('pdf.mail', ['name' => $data['name'], 'event' => $data['event']], function($message) use ($email, $pdf){
                $message->to($email)
                    ->subject('Ticket')
                    ->attachData($pdf->output(), "ticket.pdf")
                    ->embedData(QrCode::format('png')->generate('Embed me into an e-mail!'), 'QrCode.png', 'image/png');


            });

            return view('events.show', compact('event'));


        }
    }


}
