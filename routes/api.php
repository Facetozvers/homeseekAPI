<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/search', 'SearchController@index');
Route::get('/properti/best-seller', 'ListingController@getBestSeller');
Route::get('/properti/premium', 'ListingController@getPremiumListing');
Route::get('/properti/{id}', 'ListingController@show');