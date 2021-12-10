<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublicationController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

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
Route::get('/ads/{slug}/{id}', [AdsController::class, 'showAds'])->name('show.ads');

Route::group(['prefix' => 'publication/', 'middleware'=> 'auth'],function() {

//Route::resource('/', PublicationController::class);
    Route::get('/', [PublicationController::class, 'index'])->name('index.publication');
    Route::post('/', [PublicationController::class, 'store'])->name('store.publication');
    Route::get('/create', [PublicationController::class, 'create'])->name('create.publication');
    Route::get('/{id}/edit', [PublicationController::class, 'edit'])->name('edit.publication');
    Route::put('/{id}/update', [PublicationController::class, 'update'])->name('update.publication');
    Route::DELETE('/{id}', [PublicationController::class, 'destroy'])->name('destroy.publication'); 

});
Route::get('/image/{id}', [ImageController::class, 'destroy'])->name('destroy.image');
Route::get('/category/{id}', [CategoryController::class, 'destroy'])->name('destroy.category');
Auth::routes(); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

