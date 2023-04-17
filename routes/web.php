<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\SellerStallsController;
use App\Http\Controllers\Admin\StallAppointmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\APIKeysController;
// use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\Admin\NotificationController;
use App\Mail\NewUserWelcomeMail;
use App\Mail\NewOrder;
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
Route::get('/contact-us', [\App\Http\Controllers\ContactUsController::class, 'show'])->name('contact-us');
Route::post('/contact-us/submit', [\App\Http\Controllers\ContactUsController::class, 'create'])->name('contact-us.submit');
Route::get('/home', [HomeController::class, 'index'])->name('index');
Route::post('/change-market', [HomeController::class, 'selectPalengke'])->name('select.market');
Route::get('/landing', [HomeController::class, 'landingAfterRegistration']);
Route::get('/test-sms', [HomeController::class, 'testSMS']);
Route::get('/thank-you-for-signing-up', [HomeController::class, 'thankyouForSigningUp']);

Route::post('/user/login', [LoginController::class, 'userLogin'])->name('user.login');


Route::get('/verify/{email}/{code}', [HomeController::class, 'verification'])->name('user.verify');
Route::get('/registration/done', [HomeController::class, 'registrationDone'])->name('user.registration.success');
Route::get('/verification/{email}/resend', [HomeController::class, 'verification'])->name('user.verification.resend');

Route::get('/about-us/', [\App\Http\Controllers\AboutUsController::class, 'index'])->name('about-us');



Auth::routes();


//Route::get('user/checkpoint', [HomeController::class, 'checkPoint'])->name('user.checkpoint')->middleware('auth');
//Route::get('/profile', [HomeController::class, 'profile'])->name('home.profile')->middleware('auth');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth');


Route::name('buyer.')->prefix('/')->namespace('\App\Http\Controllers')->group(function(){
    Route::get('/profile/', [UserController::class, 'profile'])->name('profile');
});

Route::name('buyer.')->prefix('/buyer')->namespace('\App\Http\Controllers')->group(function(){
    Route::get('/create', [BuyerController::class, 'create'])->name('create');
    Route::post('/store', [BuyerController::class, 'store'])->name('store');
    Route::get('/profile/edit/', [ BuyerController::class, 'edit'])->name('edit');
    Route::post('/profile/update', [BuyerController::class, 'update'])->name('update');
    Route::get('/switch/seller', [BuyerController::class, 'switch_as_seller'])->name('switch.seller');


    Route::get('/delivery/address/create', [\App\Http\Controllers\Buyer\DeliveryAddressController::class, 'create'])->name('delivery.address.create');
    Route::post('/delivery/address/store/{type?}', [\App\Http\Controllers\Buyer\DeliveryAddressController::class, 'store'])->name('delivery.address.store');
    Route::get('/delivery/address/index/', [\App\Http\Controllers\Buyer\DeliveryAddressController::class, 'index'])->name('delivery.address.index');
    Route::get('/delivery/address/find/{id}', [\App\Http\Controllers\Buyer\DeliveryAddressController::class, 'find'])->name('delivery.address.find');
//    Route::post('/delivery/address/store/{type?}', [\App\Http\Controllers\Buyer\DeliveryAddressController::class, 'index'])->name('delivery.address.edit');
//    Route::post('/delivery/address/store/{type?}', [\App\Http\Controllers\Buyer\DeliveryAddressController::class, 'index'])->name('delivery.address.update');
//    Route::post('/delivery/address/store/{type?}', [\App\Http\Controllers\Buyer\DeliveryAddressController::class, 'index'])->name('delivery.address.delete');

    Route::get('/orders', [\App\Http\Controllers\Buyer\OrdersController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order_id}', [\App\Http\Controllers\Buyer\OrdersController::class, 'find'])->name('orders.find');
    Route::POST('/orders/{order_id}/cancel', [\App\Http\Controllers\Buyer\OrdersController::class, 'cancel'])->name('orders.cancel');


    //buyer to seller only
    Route::get('chats/', [\App\Http\Controllers\Buyer\ChatsController::class, 'index'])->name('chats');
    Route::get('chats/seller/{id}', [\App\Http\Controllers\Buyer\ChatsController::class, 'seller'])->name('chat.seller');
    Route::post('chats/sendMessage/{id}', [\App\Http\Controllers\Buyer\ChatsController::class, 'sendMessage'])->name('chat.sendMessage');
    Route::get('chats/fetchAllMessages/{id}', [\App\Http\Controllers\Buyer\ChatsController::class, 'fetchAllMessages'])->name('chat.fetchAllMessages');

    Route::get('/getMessagesNotification', [BuyerController::class, 'getMessagesNotification'])->name('getMessagesNotification');
    Route::get('/setUnread', [BuyerController::class, 'setUnread'])->name('setUnread');
    Route::get('/getOrdersNotification', [BuyerController::class, 'getOrdersNotification'])->name('getOrdersNotification');
});


Route::name('seller.')->prefix('/seller')->namespace('\App\Http\Controllers')->group(function(){
    Route::get('/profile', [\App\Http\Controllers\Seller\SellerController::class, 'profile'])->name('profile');
    Route::get('/create', [\App\Http\Controllers\Seller\SellerController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\Seller\SellerController::class, 'store'])->name('store');

    Route::get('/profile/edit/', [ \App\Http\Controllers\Seller\SellerController::class, 'edit'])->name('edit');
    Route::post('/profile/update', [\App\Http\Controllers\Seller\SellerController::class, 'update'])->name('update');
    Route::get('/show', [\App\Http\Controllers\Seller\SellerController::class, 'show'])->name('show');

    //products
    Route::get('/products/create', [\App\Http\Controllers\Seller\ProductsController::class, 'create'])->name('products.create');
    Route::post('/products/store', [\App\Http\Controllers\Seller\ProductsController::class, 'store'])->name('products.store');
    Route::get('/products/find/{id}', [\App\Http\Controllers\Seller\ProductsController::class, 'find'])->name('products.find');
    Route::get('/products/show', [\App\Http\Controllers\Seller\ProductsController::class, 'show'])->name('products.show');
    Route::get('/products/edit/{id}', [\App\Http\Controllers\Seller\ProductsController::class, 'edit'])->name('products.edit');
    Route::post('/products/update/', [\App\Http\Controllers\Seller\ProductsController::class, 'update'])->name('products.update');
    Route::get('/products/trash', [\App\Http\Controllers\Seller\ProductsController::class, 'trash'])->name('products.trash');
    Route::get('/products/delete/{id}', [\App\Http\Controllers\Seller\ProductsController::class, 'deleteSellerProduct'])->name('products.delete');
    Route::get('/products/permanentdelete/{id}', [\App\Http\Controllers\Seller\ProductsController::class, 'SellerProductForceDelete'])->name('products.permanentdelete');
    Route::get('/products/recover/{id}', [\App\Http\Controllers\Seller\ProductsController::class, 'recoverSellerProduct'])->name('products.recover');
    Route::post('/products/find-by-category', [\App\Http\Controllers\Seller\ProductsController::class, 'findByCategory'])->name('products.find.category');
    Route::post('/products/details', [\App\Http\Controllers\Seller\ProductsController::class, 'findByID'])->name('products.details');


    Route::get('/stalls/have-any-stalls/', [\App\Http\Controllers\Seller\SellerController::class, 'haveAnyStalls'])->name('stalls.haveany');


    Route::get('chats/', [\App\Http\Controllers\Seller\ChatsController::class, 'index'])->name('chats');
    Route::get('chats/buyer/{id}', [\App\Http\Controllers\Seller\ChatsController::class, 'buyer'])->name('chat.buyer');
    Route::post('chats/sendMessage/{id}', [\App\Http\Controllers\Seller\ChatsController::class, 'sendMessage'])->name('chat.sendMessage');
    Route::get('chats/fetchAllMessages/{id}', [\App\Http\Controllers\Seller\ChatsController::class, 'fetchAllMessages'])->name('chat.fetchAllMessages');

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
    Route::post('/stalls/update/{id}', [\App\Http\Controllers\Seller\StallsController::class, 'update'])->name('stalls.update');

    //My Stalls
    Route::get('/stalls/show', [\App\Http\Controllers\Seller\StallsController::class, 'show'])->name('stalls.show');

    Route::post('/stall/display/details/', [\App\Http\Controllers\Seller\StallsController::class, 'displayDetails'])->name('display.details');

    //Orders
    Route::get('/orders/', [\App\Http\Controllers\Seller\OrdersController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}', [\App\Http\Controllers\Seller\OrdersController::class, 'find'])->name('orders.find');
    Route::get('/orders/cod/{id}/confirmed', [\App\Http\Controllers\Seller\OrdersController::class, 'confirmCOD'])->name('orders.confirmCOD');
    Route::post('/order/status/update', [\App\Http\Controllers\Seller\OrdersController::class, 'updateStatus'])->name('orders.status.update');
    Route::get('/orders/{id}/email', function($id){

        $order = \App\Order::findOrFail($id);
        return new NewOrder($order);
    });
    Route::get('/order/{id}/update/status/email', function($id){

        $order = \App\Order::find($id);
        return new \App\Mail\NewOrderStatus($order);
    });

    Route::get('/switch/buyer', [\App\Http\Controllers\Seller\SellerController::class, 'switch_as_buyer'])->name('switch.buyer');

    Route::get('/analytics/products/', [\App\Http\Controllers\Seller\AnalyticsController::class, 'productSales'])->name('analytics.product.sales');
    Route::get('/analytics/products/export', [\App\Http\Controllers\Seller\AnalyticsController::class, 'exportProductSales'])->name('analytics.product.sales.export');
    Route::get('/analytics/products/ratings', [\App\Http\Controllers\Seller\AnalyticsController::class, 'productByRatings'])->name('analytics.product.ratings');
    Route::get('/analytics/products/ratings/export', [\App\Http\Controllers\Seller\AnalyticsController::class, 'exportProductByRatings'])->name('analytics.product.ratings.export');


    Route::get('/getMessagesNotification', [\App\Http\Controllers\Seller\SellerController::class, 'getMessagesNotification'])->name('getMessagesNotification');
    Route::get('/setUnread', [\App\Http\Controllers\Seller\SellerController::class, 'setUnread'])->name('setUnread');
//    Route::get('/analytics/products/{id}', [\App\Http\Controllers\Seller\AnalyticsController::class, 'salesByProducts'])->name('analytics.products.id');
//    Route::get('/analytics/seller/registration', [\App\Http\Controllers\Seller\AnalyticsController::class, 'sellerRegistration'])->name('analytics.sellerRegistration');
//    Route::get('/analytics/buyer/registration', [\App\Http\Controllers\Seller\AnalyticsController::class, 'buyerRegistration'])->name('analytics.buyerRegistration');
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



    Route::get('/settings/api/index', [APIKeysController::class, 'index'])->name('api.index');
    Route::get('/settings/api/create', [APIKeysController::class, 'create'])->name('api.create');
    Route::post('/settings/api/store', [APIKeysController::class, 'store'])->name('api.store');
    Route::get('/settings/api/edit', [APIKeysController::class, 'edit'])->name('api.edit');
    Route::post('/settings/api/update', [APIKeysController::class, 'update'])->name('api.update');


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
    Route::get('/users/seller/export', [\App\Http\Controllers\Admin\UserController::class, 'exportSeller'])->name('seller.export');

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

    Route::get('/stalls/export/', [\App\Http\Controllers\Admin\StallsController::class, 'exportStall'])->name('stalls.export');


    //categories
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/show', [CategoriesController::class, 'show'])->name('categories.show');
    Route::get('/categories/edit/{id}', [ CategoriesController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update/{id}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::get('/categories/trash', [CategoriesController::class, 'trash'])->name('categories.trash');
    Route::get('/categories/delete/{id}', [CategoriesController::class, 'deleteCategory'])->name('categories.delete');
    Route::get('/categories/permanentdelete/{id}', [CategoriesController::class, 'CategoryForceDelete'])->name('categories.permanentdelete');
    Route::get('/categories/recover/{id}', [CategoriesController::class, 'recoverCategory'])->name('categories.recover');

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


    Route::get('/analytics/products/{id}', [\App\Http\Controllers\Admin\AnalyticsController::class, 'salesByProducts'])->name('analytics.products');
    Route::get('/analytics/seller/registration', [\App\Http\Controllers\Admin\AnalyticsController::class, 'sellerRegistration'])->name('analytics.sellerRegistration');
    Route::get('/analytics/buyer/registration', [\App\Http\Controllers\Admin\AnalyticsController::class, 'buyerRegistration'])->name('analytics.buyerRegistration');

    Route::get('/contact-us/', [\App\Http\Controllers\Admin\ContactUsController::class, 'index'])->name('contact-us');
    Route::get('/contact-us/{id}', [\App\Http\Controllers\Admin\ContactUsController::class, 'find'])->name('contact-us.find');

    Route::get('/about-us/', [\App\Http\Controllers\Admin\AboutUsController::class, 'index'])->name('about-us.index');
    Route::POST('/about-us/store', [\App\Http\Controllers\Admin\AboutUsController::class, 'store'])->name('about-us.store');
    Route::get('/about-us/developers', [\App\Http\Controllers\Admin\AboutUsController::class, 'developers'])->name('developers');
    Route::get('/about-us/developers/create', [\App\Http\Controllers\Admin\AboutUsController::class, 'developers_create'])->name('developers.create');
    Route::post('/about-us/developers/store', [\App\Http\Controllers\Admin\AboutUsController::class, 'developers_store'])->name('developers.store');
    Route::get('/about-us/developers/edit/{id}', [\App\Http\Controllers\Admin\AboutUsController::class, 'developers_edit'])->name('developers.edit');
    Route::post('/about-us/developers/update/{id}', [\App\Http\Controllers\Admin\AboutUsController::class, 'developers_update'])->name('developers.update');
    Route::get('/about-us/developers-trash', [\App\Http\Controllers\Admin\AboutUsController::class, 'showDeveloperTrash'])->name('developers-trash');
    Route::get('/about-us/delete/{id}', [\App\Http\Controllers\Admin\AboutUsController::class, 'deleteDeveloper'])->name('developers.delete');
    Route::get('/about-us/permanentdelete/{id}', [\App\Http\Controllers\Admin\AboutUsController::class, 'DeveloperForceDelete'])->name('developers.permanentdelete');
    Route::get('/about-us/recover/{id}', [\App\Http\Controllers\Admin\AboutUsController::class, 'recoverDeveloper'])->name('developers.recover');

    //markets
    Route::get('/markets/show', [\App\Http\Controllers\Admin\MarketsController::class, 'show'])->name('markets.show');
    Route::get('/markets/edit/{id}', [\App\Http\Controllers\Admin\MarketsController::class, 'edit'])->name('markets.edit');
    Route::post('/markets/update/{id}', [\App\Http\Controllers\Admin\MarketsController::class, 'update'])->name('markets.update');
    Route::get('/markets/create', [\App\Http\Controllers\Admin\MarketsController::class, 'create'])->name('markets.create');
    Route::post('/markets/store', [\App\Http\Controllers\Admin\MarketsController::class, 'store'])->name('markets.store');
});

Route::get('/products/category/{slug}', [ ProductsController::class, 'showByCategory'])->name('products.category');

Route::get('/test/mail', function (){
   return new NewUserWelcomeMail();
});
Route::get('/test/match', function (){
    if (preg_match("~^9\d+$~", '8178402141')) {
        dd('true');
    }else{

        dd('false');
    }
});
/*
Route::get('/chat', 'ChatsController@index');
Route::get('/chat/messages', 'ChatsController@fetchMessages');
Route::post('/chat/messages', 'ChatsController@sendMessage');*/

Route::get('/stall/appointment/pending', [AdminController::class, 'getStallAppointmentNotif'])->name('get.stall.appointment.notif');
Route::get('/stall/approval/pending', [AdminController::class, 'getStallApprovalNotif'])->name('get.stall.approval.notif');
Route::get('/stall/product/pending', [AdminController::class, 'getProductApprovalNotif'])->name('get.product.approval.notif');
Route::get('/notif', [AdminController::class, 'getNotifications'])->name('get.notif');


//displaybycategory

Route::name('shop.')->prefix('/shop')->namespace('\App\Http\Controllers')->group(function(){
    Route::get('/categories/', [\App\Http\Controllers\ProductsController::class, 'categories'])->name('categories');
    Route::get('/category/{slug}', [\App\Http\Controllers\ProductsController::class, 'showByCategory'])->name('product.category');
    Route::post('/add-to-cart/', [\App\Http\Controllers\ProductsController::class, 'addToCart'])->name('product.addToCart');
    Route::get('/products/', [ \App\Http\Controllers\ProductsController::class, 'index'])->name('products.index');
    Route::get('/product/{id}', [ \App\Http\Controllers\ProductsController::class, 'find'])->name('products.find');
    Route::post('/product/post/comment/{id}', [ \App\Http\Controllers\ProductsController::class, 'postComment'])->name('products.post.comment');
    Route::get('/stores', [ \App\Http\Controllers\ProductsController::class, 'sellers'])->name('stores');
    Route::get('/store/{id}', [ \App\Http\Controllers\ProductsController::class, 'findStore'])->name('store.find');

});

Route::name('cart.')->prefix('/cart')->namespace('\App\Http\Controllers')->group(function(){
    Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('index');
    Route::get('/delete/{id}', [\App\Http\Controllers\CartController::class, 'delete'])->name('delete');
    Route::post('/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
    Route::get('/chooseDeliveryAddress', [\App\Http\Controllers\CartController::class, 'chooseDeliveryAddress'])->name('checkout.chooseDeliveryAddress');
    Route::post('/selectDeliveryAddress', [\App\Http\Controllers\CartController::class, 'selectDeliveryAddress'])->name('checkout.selectDeliveryAddress');
    Route::get('/choosePaymentMethod', [\App\Http\Controllers\CartController::class, 'choosePaymentMethod'])->name('checkout.choosePaymentMethod');
    Route::post('/selectPaymentMethod', [\App\Http\Controllers\CartController::class, 'selectPaymentMethod'])->name('checkout.selectPaymentMethod');

});


Route::get('/paywithpaypal', array('as' => 'paywithpaypal','uses' => 'PaypalController@payWithPaypal',));
Route::post('/paypal', array('as' => 'paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
Route::get('/paypal'    , array('as' => 'status','uses' => 'PaypalController@getPaymentStatus',));
