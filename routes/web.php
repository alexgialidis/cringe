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
Route::get('/events/{event}', 'EventController@show');

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
