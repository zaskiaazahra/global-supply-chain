<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [

        'shipment_code',

        'cargo_name',

        'origin_country',

        'destination_country',

        'transport_type',

        'weight',

        'status',

        'departure_date',

        'estimated_arrival',

        'latitude',

        'longitude'

    ];
}