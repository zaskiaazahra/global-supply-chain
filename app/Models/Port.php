<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    protected $fillable = [

        'country_code',

        'region',

        'port_name',

        'harbor_type',

        'harbor_size',

        'latitude',

        'longitude'

    ];
}