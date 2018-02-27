<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('human')->user();

    //dd($users);

    return view('human.home');
})->name('home');

