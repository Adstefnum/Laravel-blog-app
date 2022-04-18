<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostsController;
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

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'])->group( function (){
        Route::get('/dashboard',[DashboardController::class,'dashboard'])
            ->name('dashboard');
    });
Route::get('/create', [PostsController::class, 'create'])->name('create');
Route::post('/store', [PostsController::class, 'store'])->name('store');
//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified'
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('pages.dashboard');
//    })->name('dashboard');
//});

