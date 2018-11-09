<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weatherstation extends Model
{
    protected $fillable = [
        
       'name',
       'code',
       'province',
        'owner',
        'loc', 
        'lat', 
        'lon', 
        'alt',
         'state',
       
    ];
}
