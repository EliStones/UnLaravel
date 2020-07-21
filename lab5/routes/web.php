<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// For ease of use, the routes are not authenticated
Route::get('/car', 'CarController@index')->name('car.index');
Route::get('/car/{id}', 'CarController@show')->name('car.show');
Route::post('/addCar','CarController@create')->name('car.create');
Route::get('/createCar', 'CarController@create')->name('car.create');

Route::get('/reviews/{id}', 'ReviewController@index');
Route::get('/addReview/{id}', 'ReviewController@create');
Route::post('/addReview/{id}', 'ReviewController@create');
Route::get('/review/{id}/getCar', 'ReviewController@getCar');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
