<?php

namespace App\Http\Controllers\ProviderAuth;

use App\Provider;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

require(__DIR__ . '/../maps.php');


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/provider/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('provider.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:providers',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Provider
     */
    protected function create(array $data)
    {
        $key = 'AIzaSyDyyd0zM6OUe4PflYQ1_BD-feq3omU9zK0';

        $search = implode(', ', [$data['address'], $data['number'], $data['zip']]);

        $geoData = google_maps_search($search, $key);

        $mapData = map_google_search_result($geoData);

        return Provider::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'afm' => $data['afm'],
            'company' => $data['company'],
            'city' => $data['city'],
            'zip' => $data['zip'],
            'address' => $data['address'],
            'number' => $data['number'],
            'lat' => $mapData['lat'],
            'long' => $mapData['lng'],
            'lock' => false,

        ]);
}

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('provider.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('provider');
    }
}
