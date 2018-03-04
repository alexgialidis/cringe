<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/events', 'EventController@index');
Route::get('/events/create', 'EventController@create')->middleware('provider');
Route::get('/events/stats', 'EventController@stats')->middleware('provider');

Route::get('/events/search', 'EventController@search');

Route::get('/events/loadstats', 'EventController@readData')->middleware('provider');
Route::get('/admin/viewdataH', 'AdminController@viewDataH')->middleware('admin');
Route::get('/admin/viewdataP', 'AdminController@viewDataP')->middleware('admin');

Route::get('/admin/lockhuman', 'AdminController@lockHuman')->middleware('admin');
Route::get('/admin/lockprovider', 'AdminController@lockProvider')->middleware('admin');
Route::get('/admin/deleteprovider', 'AdminController@deleteProvider')->middleware('admin');
Route::get('/admin/deletehuman', 'AdminController@deleteHuman')->middleware('admin');

Route::get('/events/{event}', 'EventController@show');
Route::get('/events/{event}/buy', 'EventController@buy')->middleware('human');


Route::post('/events', 'EventController@store');

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'provider'], function () {
    Route::get('/profile', function () {
        return view('provider.profile', ['provider' => Auth::guard('provider')->user()]);
    })->middleware('provider');
  Route::get('/login', 'ProviderAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'ProviderAuth\LoginController@login');
  Route::post('/logout', 'ProviderAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'ProviderAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'ProviderAuth\RegisterController@register');

  Route::post('/password/email', 'ProviderAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'ProviderAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'ProviderAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'ProviderAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'human'], function () {
  Route::get('/addPoints', 'HumanController@addPoints')->middleware('human');
  Route::get('/profile', function () {
      return view('human.profile', ['human' => Auth::guard('human')->user()]);
  })->middleware('human');
  Route::get('/login', 'HumanAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'HumanAuth\LoginController@login');
  Route::post('/logout', 'HumanAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'HumanAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'HumanAuth\RegisterController@register');

  Route::post('/password/email', 'HumanAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'HumanAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'HumanAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'HumanAuth\ResetPasswordController@showResetForm');
});
