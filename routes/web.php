<?php

use App\Http\Controllers\Admin\ AdminController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\SellerStallsController;
use App\Http\Controllers\Admin\StallAppointmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CategoriesController;
// use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\Admin\NotificationController;
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
Route::get('/home', [HomeController::class, 'index'])->name('index');





Auth::routes();


//Route::get('user/checkpoint', [HomeController::class, 'checkPoint'])->name('user.checkpoint')->middleware('auth');
Route::get('/profile', [HomeController::class, 'profile'])->name('home.profile')->middleware('auth');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth');


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

    //products
    Route::get('/products/create', [\App\Http\Controllers\Seller\ProductsController::class, 'create'])->name('products.create');
    Route::post('/products/store', [\App\Http\Controllers\Seller\ProductsController::class, 'store'])->name('products.store');
    Route::get('/products/show', [\App\Http\Controllers\Seller\ProductsController::class, 'show'])->name('products.show');
    Route::get('/products/edit/{id}', [\App\Http\Controllers\Seller\ProductsController::class, 'edit'])->name('products.edit');
    Route::post('/products/update/', [\App\Http\Controllers\Seller\ProductsController::class, 'update'])->name('products.update');
    Route::post('/products/find-by-category', [\App\Http\Controllers\Seller\ProductsController::class, 'findByCategory'])->name('products.find.category');
    Route::post('/products/details', [\App\Http\Controllers\Seller\ProductsController::class, 'findByID'])->name('products.details');


    Route::get('/stalls/have-any-stalls/', [SellerController::class, 'haveAnyStalls'])->name('stalls.haveany');

//    Stalls
    /*Has Stall*/
    Route::get('/stalls/has/select', [\App\Http\Controllers\Seller\StallsController::class, 'hasSelect'])->name('stalls.has.select');
    Route::get('/stalls/has/create/{id}', [\App\Http\Controllers\Seller\StallsController::class, 'hasCreate'])->name('stalls.has.create');
    //Route::get('/stalls/create/details', [SellerController::class, 'stallCreateDetails'])->name('stalls.create.details');
    Route::post('/stalls/store/details', [\App\Http\Controllers\Seller\StallsController::class, 'storeDetails'])->name('stalls.store.details');

    /*No Stall*/
    Route::get('/stalls/create/{id}', [\App\Http\Controllers\Seller\StallsController::class, 'create'])->name('stalls.create');
    Route::post('/stalls/store', [\App\Http\Controllers\Seller\StallsController::class, 'store'])->name('stalls.store');
    Route::get('/stalls/select', [\App\Http\Controllers\Seller\StallsController::class, 'select'])->name('stalls.select');
    Route::post('/stalls/upload/contract', [\App\Http\Controllers\Seller\StallsController::class, 'submitContract'])->name('stalls.contract');

    Route::get('/stalls/edit/{id}', [\App\Http\Controllers\Seller\StallsController::class, 'edit'])->name('stalls.edit');
    Route::post('/stalls/update/', [\App\Http\Controllers\Seller\StallsController::class, 'update'])->name('stalls.update');

    //My Stalls
    Route::get('/stalls/show', [\App\Http\Controllers\Seller\StallsController::class, 'show'])->name('stalls.show');

    Route::post('/stall/display/details/', [\App\Http\Controllers\Seller\StallsController::class, 'displayDetails'])->name('display.details');

    //Orders
    Route::get('/orders/', [\App\Http\Controllers\Seller\OrdersController::class, 'show'])->name('orders.show');


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
    Route::get('/users/staff-edit/{id}', [AdminController::class, 'edit'])->name('edit.staff');
    Route::post('/users/staff-update/{id}',  [AdminController::class, 'update'])->name('update.staff');
    Route::get('/users/staff/trash', [AdminController::class, 'showStaffTrash'])->name('show.staffs.trash');
    Route::get('/staffs/delete/{id}', [AdminController::class, 'deleteStaff'])->name('staffs.delete');
    Route::get('/staffs/permanentdelete/{id}', [AdminController::class, 'StaffForceDelete'])->name('staffs.permanentdelete');
    Route::get('/staffs/recover/{id}', [AdminController::class, 'recoverStaff'])->name('staffs.recover');
    Route::get('/set/market', [AdminController::class, 'setMarket'])->name('set.market');
    Route::get('/settings/', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings/update/password', [AdminController::class, 'updatePassword'])->name('update.password');

    //users
    Route::get('/users/show', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
    Route::get('/users/buyers/list', [\App\Http\Controllers\Admin\UserController::class, 'showBuyer'])->name('show.buyers.list');
    Route::get('/users/buyers/trash', [\App\Http\Controllers\Admin\UserController::class, 'showBuyerTrash'])->name('show.buyers.trash');
    Route::get('/buyers/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'deleteBuyer'])->name('buyers.delete');
    Route::get('/buyers/permanentdelete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'BuyerForceDelete'])->name('buyers.permanentdelete');
    Route::get('/buyers/recover/{id}', [\App\Http\Controllers\Admin\UserController::class, 'recoverBuyer'])->name('buyers.recover');
    Route::get('/users/sellers/list', [\App\Http\Controllers\Admin\UserController::class, 'showSellerList'])->name('show.sellers.list');
    Route::get('/users/sellers/trash', [\App\Http\Controllers\Admin\UserController::class, 'showSellerTrash'])->name('show.sellers.trash');
    Route::get('/sellers/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'deleteSeller'])->name('sellers.delete');
    Route::get('/sellers/permanentdelete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'SellerForceDelete'])->name('sellers.permanentdelete');
    Route::get('/sellers/recover/{id}', [\App\Http\Controllers\Admin\UserController::class, 'recoverSeller'])->name('sellers.recover');
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
    Route::get('/products/approve/{id}', [ProductsController::class, 'approve'])->name('products.approve');
    Route::get('/products/trash', [ProductsController::class, 'trash'])->name('products.trash');
    Route::get('/products/delete/{id}', [ProductsController::class, 'deleteProduct'])->name('products.delete');
    Route::get('/products/permanentdelete/{id}', [ProductsController::class, 'ProductForceDelete'])->name('products.permanentdelete');
    Route::get('/products/recover/{id}', [ProductsController::class, 'recoverProduct'])->name('products.recover');



    //stalls
    Route::get('/stalls/show', [\App\Http\Controllers\Admin\StallsController::class, 'show'])->name('stalls.show');
    Route::get('/stalls/find/{id}', [\App\Http\Controllers\Admin\StallsController::class, 'find'])->name('stalls.find');
    Route::get('/stalls/create', [\App\Http\Controllers\Admin\StallsController::class, 'create'])->name('stalls.create');
    Route::post('/stalls/store', [\App\Http\Controllers\Admin\StallsController::class, 'store'])->name('stalls.store');
    Route::get('/stalls/edit/{id}', [\App\Http\Controllers\Admin\StallsController::class, 'edit'])->name('stalls.edit');
    Route::post('/stalls/update/{id}', [\App\Http\Controllers\Admin\StallsController::class, 'update'])->name('stalls.update');
    Route::get('/stalls/trash', [\App\Http\Controllers\Admin\StallsController::class, 'trash'])->name('stalls.trash');
    Route::get('/stalls/delete/{id}', [\App\Http\Controllers\Admin\StallsController::class, 'deleteStall'])->name('stalls.delete');
    Route::get('/stalls/permanentdelete/{id}', [\App\Http\Controllers\Admin\StallsController::class, 'StallForceDelete'])->name('stalls.permanentdelete');
    Route::get('/stalls/recover/{id}', [\App\Http\Controllers\Admin\StallsController::class, 'recoverStall'])->name('stalls.recover');


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

    Route::get('/notif/show', [NotificationController::class, 'show'])->name('notifications.show');


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
Route::get('/notif', [AdminController::class, 'getNotifications'])->name('get.notif');


//displaybycategory

Route::name('shop.')->prefix('/shop')->namespace('\App\Http\Controllers')->group(function(){
    Route::get('/category/{category}', [\App\Http\Controllers\ProductsController::class, 'showByCategory'])->name('product.category');
    Route::post('/add-to-cart/', [\App\Http\Controllers\ProductsController::class, 'addToCart'])->name('product.addToCart');
});

Route::name('cart.')->prefix('/cart')->namespace('\App\Http\Controllers')->group(function(){
    Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('index');
    Route::post('/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
});


Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => 'PaypalController@payWithPaypal',));
Route::post('paypal', array('as' => 'paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'status','uses' => 'PaypalController@getPaymentStatus',));