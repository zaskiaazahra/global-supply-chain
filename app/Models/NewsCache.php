<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCache extends Model
{
    protected $table = 'news_cache';

    protected $fillable = [

        'country',

        'category',

        'response',

        'cached_at'

    ];

    protected $casts = [

        'cached_at' => 'datetime'

    ];
}