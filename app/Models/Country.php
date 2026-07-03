<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iso2',
        'iso3',
        'capital',
        'region',
        'subregion',
        'currency_code',
        'currency_name',
        'latitude',
        'longitude',
        'flag_url',
    ];
}