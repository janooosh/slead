<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Scrape extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrapes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->boolean('gtm');
            $table->boolean('ganalytics');
            $table->boolean('gads');
            $table->boolean('gsite');
            $table->string('fb_links');
            $table->string('ig_links');
            $table->string('twitter_links');
            $table->string('linkedin_links');
            $table->string('cms');
            $table->string('cms_version')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
