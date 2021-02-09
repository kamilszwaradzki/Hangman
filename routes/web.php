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
    return view('home');
});
Route::get('modified/{difficulty}/{id}','WordController@getModifiedRecord');
Route::get('contain/{difficulty}/{id}','WordController@isWordContainSelectedLetter');
Route::get('count/{difficulty}','WordController@getCountRecords');
Route::get('wholeword/{difficulty}/{id}','WordController@getWord');