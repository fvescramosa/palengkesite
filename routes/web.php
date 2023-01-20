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


Route::name('seller.')->prefix('/seller')->namespace('\App\Http\Controllers')->group(function(){
    Route::get('/profile', [SellerController::class, 'profile'])->name('profile');

    Route::get('/create', [SellerController::class, 'create'])->name('create');
    Route::post('/store', [SellerController::class, 'store'])->name('store');

    Route::get('/profile/edit/', [ SellerController::class, 'edit'])->name('edit');
    Route::post('/profile/update', [SellerController::class, 'update'])->name('update');

    Route::get('/show', [SellerController::class, 'show'])->name('show');

    Route::get('/products/create', [SellerController::class, 'productsCreate'])->name('products.create');
    Route::post('/products/store', [SellerController::class, 'productStore'])->name('products.store');

    Route::get('/products/show', [SellerController::class, 'productShow'])->name('products.show');

    Route::get('/products/edit/{id}', [SellerController::class, 'productEdit'])->name('products.edit');
    Route::post('/products/update/', [SellerController::class, 'productUpdate'])->name('products.update');

    Route::post('/products/find-by-category', [SellerController::class, 'findProductsByCategory'])->name('products.find.category');

    /*Has Stall*/
    Route::get('/stalls/has/select', [SellerController::class, 'stallHasSelect'])->name('stalls.has.select');
    Route::get('/stalls/has/create/{id}', [SellerController::class, 'stallHasCreate'])->name('stalls.has.create');
    //Route::get('/stalls/create/details', [SellerController::class, 'stallCreateDetails'])->name('stalls.create.details');
    Route::post('/stalls/store/details', [SellerController::class, 'stallStoreDetails'])->name('stalls.store.details');

    /*No Stall*/
    Route::get('/stalls/create/{id}', [SellerController::class, 'stallCreate'])->name('stalls.create');
    Route::post('/stalls/store', [SellerController::class, 'stallStore'])->name('stalls.store');
    Route::get('/stalls/select', [SellerController::class, 'stallSelect'])->name('stalls.select');
    Route::post('/stalls/upload/contract', [SellerController::class, 'submitContract'])->name('stalls.contract');

    Route::get('/stalls/edit/{id}', [SellerController::class, 'stallEdit'])->name('stalls.edit');
    Route::post('/stalls/update/', [SellerController::class, 'stallUpdate'])->name('stalls.update');
    Route::get('/stalls/have-any-stalls/', [SellerController::class, 'haveAnyStalls'])->name('stalls.haveany');

    //My Stalls
    Route::get('/stalls/show', [SellerController::class, 'stallShow'])->name('stalls.show');


    Route::post('/stall/display/details/', [SellerController::class, 'display_details'])->name('display.details');
    Route::get('/switch/buyer', [SellerController::class, 'switch_as_buyer'])->name('switch.buyer');
});


Route::name('admin.')->prefix('/admin')->namespace('\App\Http\Controllers\Admin')->group(function() {
    Route::get('/login', [LoginController::class, 'showAdminLoginForm'])->name('login');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});
Route::name('admin.')->prefix('/admin')->namespace('\App\Http\Controllers\Admin')->group(function(){
    Route::get('', [AdminController::class, 'index'])->name('index');
    Route::post('/login', [LoginController::class, 'adminLogin'])->name('signup');
    Route::get('/register', [RegisterController::class, 'showAdminRegisterForm'])->name('register');
    Route::post('/store', [ RegisterController::class, 'createAdmin'])->name('store');
    Route::get('/users/staff', [AdminController::class, 'show'])->name('show.staff');
    Route::get('/set/market', [AdminController::class, 'setMarket'])->name('set.market');

    //users
    Route::get('/users/show', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
    Route::get('/users/buyers/list', [\App\Http\Controllers\Admin\UserController::class, 'showBuyer'])->name('show.buyers.list');
    Route::get('/users/sellers/list', [\App\Http\Controllers\Admin\UserController::class, 'showSellerList'])->name('show.sellers.list');
    Route::get('/users/sellers/trash', [\App\Http\Controllers\Admin\UserController::class, 'showSellerTrash'])->name('show.sellers.trash');
    Route::get('/users/seller/show/{id}', [\App\Http\Controllers\Admin\UserController::class, 'showSeller'])->name('show.seller');
    Route::get('/users/edit/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/update/{id}',  [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::get('/users/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('users.delete');
    Route::get('/users/recover/{id}', [\App\Http\Controllers\Admin\UserController::class, 'retrieve'])->name('users.retrieve');

    //products
    Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/products/show', [ProductsController::class, 'show'])->name('products.show');
    Route::get('/products/edit/{id}', [ ProductsController::class, 'edit'])->name('products.edit');
    Route::post('/products/update/{id}', [ProductsController::class, 'update'])->name('products.update');



    //stalls
    Route::get('/stalls/show', [\App\Http\Controllers\Admin\StallsController::class, 'show'])->name('stalls.show');
    Route::get('/stalls/find/{id}', [\App\Http\Controllers\Admin\StallsController::class, 'find'])->name('stalls.find');
    Route::get('/stalls/create', [\App\Http\Controllers\Admin\StallsController::class, 'create'])->name('stalls.create');
    Route::post('/stalls/store', [\App\Http\Controllers\Admin\StallsController::class, 'store'])->name('stalls.store');
    Route::get('/stalls/edit/{id}', [\App\Http\Controllers\Admin\StallsController::class, 'edit'])->name('stalls.edit');
    Route::post('/stalls/update/{id}', [\App\Http\Controllers\Admin\StallsController::class, 'update'])->name('stalls.update');


    //categories
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/show', [CategoriesController::class, 'show'])->name('categories.show');
    Route::get('/categories/edit/{id}', [ CategoriesController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update/{id}', [CategoriesController::class, 'update'])->name('categories.update');

    //seller stalls
    Route::get('/seller/stalls', [SellerStallsController::class, 'index'])->name('seller.stalls.show');
    Route::post('/seller/approve', [SellerStallsController::class, 'approve'])->name('seller.stalls.approve');
    Route::post('/seller/upload/contract', [SellerStallsController::class, 'uploadContract'])->name('seller.stalls.upload.contract');


    //Appointments
    Route::get('/appointments/show', [StallAppointmentController::class, 'index'])->name('appointments.show');
    Route::post('/appointments/approve', [StallAppointmentController::class, 'approve'])->name('appointments.approve');

    //Price Monitoring
    Route::get('/pricing/show/{id}', [PricingController::class, 'index'])->name('pricing.show');



});

Route::get('/products/category/{category}', [ ProductsController::class, 'showByCategory'])->name('products.category');
Route::get('/test/mail', function (){
   return new NewUserWelcomeMail();
});

Route::get('/chat', 'ChatsController@index');
Route::get('/chat/messages', 'ChatsController@fetchMessages');
Route::post('/chat/messages', 'ChatsController@sendMessage');

Route::get('/stall/appointment/pending', [AdminController::class, 'getStallAppointmentNotif'])->name('get.stall.appointment.notif');
Route::get('/stall/approval/pending', [AdminController::class, 'getStallApprovalNotif'])->name('get.stall.approval.notif');


