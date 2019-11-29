<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scrape extends Model
{
    protected $fillable = [
        'url', 'gtm', 'gandsalytics','gads','gsite','fb_links','ig_links','twitter_links','linkedin_links','fb_pixel'
    ];
}
