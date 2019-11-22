<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scrape extends Model
{
    protected $fillable = [
        'url', 'gtm', 'gandsalytics','gads','gsite'
    ];
}
