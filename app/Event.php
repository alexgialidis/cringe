<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Event extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_id',
        'title',
        'date',
        'price',
        'description',
        'min_age',
        'max_age',
        'category',
        'availability',
        'sold',
        'city',
        'address',
        'number',
        'zip',
        'lat',
        'long',
        'views_guests',
        'views_humans',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
