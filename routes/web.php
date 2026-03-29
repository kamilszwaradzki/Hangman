<?php

use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('modified/{difficulty}/{id}', [WordController::class, 'getModifiedRecord']);
Route::get('contain/{difficulty}/{id}', [WordController::class, 'isWordContainSelectedLetter']);
Route::get('count/{difficulty}', [WordController::class, 'getCountRecords']);
Route::get('wholeword/{difficulty}/{id}', [WordController::class, 'getWord']);
