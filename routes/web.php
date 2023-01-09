<?php

use App\Http\Controllers\Admin\ AdminController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\SellerStallsController;
use App\Http\Controllers\Admin\StallAppointmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CategoriesController;
// use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BuyerController;
use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ProductsController;
use \App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|g
*/


Route::get('/', [HomeController::class, 'index'])->name('index');





Auth::routes();


//Route::get('user/checkpoint', [HomeController::class, 'checkPoint'])->name('user.checkpoint')->middleware('auth');
Route::get('/profile', [HomeController::class, 'profile'])->name('home.profile')->middleware('auth');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth');


Route::name('buyer.')->prefix('/')->namespace('\App\Http\Controllers')->group(function(){
    Route::get('/profile/{id}', [UserController::class, 'profile'])->name('profile');
});

Route::name('buyer.')->prefix('/buyer')->namespace('\App\Http\Controllers')->group(function(){
    Route::get('/create', [BuyerController::class, 'create'])->name('create');
    Route::post('/store', [BuyerController::class, 'store'])->name('store');
    Route::get('/switch/seller', [BuyerController::class, 'switch_as_seller'])->name('switch.seller');
});

