<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiskScore extends Model
{
    protected $fillable = [

        'country',

        'weather_risk',

        'inflation_risk',

        'currency_risk',

        'news_risk',

        'total_risk',

        'risk_level'

    ];
}