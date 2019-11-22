<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/','ScrapeController@index')->name('home');

Route::post('/','ScrapeController@scrapeTest')->name('scrape');
Route::get('/update/{id}','ScrapeController@update')->name('update');
Route::get('/delete/{id}','ScrapeController@delete')->name('delete');
