<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
use App\Models\Category;

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
/* 
Route::get('/', function () {
    return view('welcome');
}); */


Route::get('/', [AdsController::class, 'index'])->name('index');
Route::get('/category', [AdsController::class, 'category'])->name('category');
Route::get('/ads', [AdsController::class, 'ads'])->name('ads');
Route::get('/ads/{id}', [AdsController::class, 'showCategory'])->name('category.ads');
Route::get('/ads/{slug}/{id}', [AdsController::class, 'showAds']);