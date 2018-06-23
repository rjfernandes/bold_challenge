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


Route::get('/', 'MainController@index');
Route::get('/reviews/{slug}', 'MainController@reviews');
Route::get('/app.js', 'MainController@jsPage');

Route::group(['prefix' => 'download'], function() {
    Route::get('', 'DownloadController@index');
    Route::get('/store-reviews/{slug}', 'DownloadController@storeReviews');
    Route::post('/configure-time-interval', 'DownloadController@configureTime');
    Route::get('/app.js', 'DownloadController@jsPage');
});
