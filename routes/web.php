<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UsersController;
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

Route::get('/authorization', function () {
    return view('authorization');
})->name('authorization');
Route::get('/pop', function () {
    return view('pop-ap');
});
Route::get('/',[NewsController::class,'fetchNews'])->name('home');
Route::get('/news/{id}',[NewsController::class,'fetchNewsForId']);
Route::post('/registration/login',[UsersController::class,'login']);
Route::post('/registration/registration',[UsersController::class,'add']);
Route::group(['middleware'=>'auth'], function () {
    Route::get('/logout',[UsersController::class,'logout']);
    Route::get('/admin/update/{id}',[AdminController::class,'updateMessage']);
    Route::get('/admin/delete-news/{id}',[NewsController::class,'deleteNews']);
    Route::get('/admin',[AdminController::class,'index'])->name('admin');
    Route::post('/admin/news_add',[NewsController::class,'addNews']);
    Route::post('/admin/update-news/{id}',[NewsController::class,'updateNews']);
});






