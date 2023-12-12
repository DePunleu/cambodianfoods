<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthUserController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\ItemDetailController;
use App\Http\Controllers\User\OrderHistoryController;
use App\Http\Controllers\User\ReviewController;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SupplierController;



use App\Http\Controllers\Seller\AuthSellerController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\SellerItemController;
use App\Http\Controllers\Seller\SellerOrderController;

use App\Http\Controllers\Accountant\AuthAccountantController;
use App\Http\Controllers\Accountant\AccountantController;
use App\Http\Controllers\Accountant\AccountantDashboardController;
use App\Http\Controllers\Accountant\AccountantItemController;
use App\Http\Controllers\Accountant\AccountantOrderController;












/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('user.index');
// })->name('home');
//=======================================================================//
//==============================User Route Here==========================//
//=======================================================================//

/*============= Home route ==================*/
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home')->name('home');
})->middleware('cache');

/*============= User Auth route ==================*/
Route::controller(AuthUserController::class)->group(function () {
    Route::get('/login', 'user_login')->name('user_login');
    Route::post('/login', 'user_loginPost')->name('user_login.post');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'registerPost')->name('register.post');
    Route::post('/logout', 'user_logout')->name('user_logout');
    Route::get('/signup', 'signup')->name('signup');
})->middleware('cache');

//================Profile Details Route=========================//
Route::controller(ProfileController::class)->middleware('authuser')->group(function () {
    Route::get('/profile', 'profile')->name('user.profile');
    Route::post('/profile', 'profilePost')->name('user_profile.post');
    Route::get('/change_password', 'changePassword')->name('user.change-password');
    Route::post('/change_password', 'updatePassword')->name('user.update-password');
})->middleware('cache');

//================Subpages Route=========================//
Route::controller(HomeController::class)->group(function () {
    Route::get('/menu', 'menu')->name('user.menu');
    Route::get('/menu/{menuId}', 'showMenuItems')->name('user.menu_items');
    Route::get('/about', 'about')->name('user.about'); 
    Route::get('/search', 'search')->name('user.search'); 
})->middleware('cache');

//================Cart Route=========================//
Route::controller(CartController::class)->middleware('authuser')->group(function () {
    Route::post('/addcart/{id}', 'addcartPost')->name('user.addcartPost');
    Route::get('/cart', 'cart')->name('user.cart');
    Route::get('/cart/{id}', 'delete_cart')->name('user.delete_cart');
    Route::patch('/update_cart', 'update_cart')->name('user.update_cart');
})->middleware('cache');

//================Cart Route=========================//
Route::controller(PaymentController::class)->middleware('authuser')->group(function () {
    Route::get('/card', 'card')->name('user.card');
    Route::post('/card', 'cardPost')->name('user.cardPost');
   // Route::get('/cash', 'cash')->name('user.cash');
    Route::get('/checkout', 'checkout')->name('user.checkout');
    Route::post('/checkout', 'checkoutPost')->name('user.checkoutPost');
})->middleware('cache');

//================ItemDetail Route=========================//
Route::controller(ItemDetailController::class)->group(function () {
    Route::get('/item_detail/{itemId}', 'item_detail')->name('user.item_detail');
    Route::post('/add_cart/{id}', 'addcart')->name('user.addcart');
})->middleware('cache');

//================Order History and Invoice Route=========================//
Route::controller(OrderHistoryController::class)->middleware('authuser')->group(function () {
    Route::get('/order_history', 'order_history')->name('user.order_history');
    Route::get('/invoice/{orderId}', 'invoice')->name('user.invoice');
    Route::get('/cancel/{id}', 'cancel')->name('user.cancel');
})->middleware('cache');

//================Review Route=========================//
Route::controller(ReviewController::class)->middleware('authuser')->group(function () {
    Route::get('/review/{orderId}', 'review')->name('user.review');
    Route::post('/review/{orderId}', 'reviewPost')->name('user.reviewPost');
})->middleware('cache');

//=======================================================================//
//==============================End User Route Here======================//
//=======================================================================//



//=======================================================================//
//==============================Admin Route Here==========================//
//=======================================================================//

/*============= Admin Auth route ==================*/
Route::controller(AuthAdminController::class)->group(function () {
    Route::get('/admin', 'admin_login')->name('admin_login');
    Route::post('/admin', 'admin_loginPost')->name('admin_login.post');
    Route::get('/admin/logout', 'logout');
})->middleware('cache');

//================Admin Dashboard Route=========================//
Route::controller(DashboardController::class)->middleware('authadmin')->group(function () {
    Route::get('/admin/dashboard', 'dashboard')->name('dashboard');  
    })->middleware('cache');

//================Admin Management Route=========================//
Route::controller(AdminController::class)->middleware('authadmin')->group(function () {
    Route::get('/admin/check_current_password', 'check_current_password');
    Route::match(['get','post'],'/admin/update_password', 'update_password');
    Route::match(['get','post'],'/admin/update_details', 'update_details');  
    })->middleware('cache');

//================Admin Users Management Route=========================//
Route::controller(UserController::class)->middleware('authadmin')->group(function () {
    Route::get('/admin/users', 'users')->name('admin.users');
    Route::get('/admin/create_users', 'create_user')->name('admin.create_users');
    Route::post('/admin/create_users', 'create_userPost')->name('admin.create_users.post');
    Route::get('/admin/update_users/{id}', 'update_user')->name('admin.update_users');
    Route::post('/admin/update_users/{id}', 'update_userPost')->name('admin.update_users.post');
    Route::get('/admin/users/{id}', 'delete')->name('admin.delete_users');
    Route::post('/updateUserRole/{userId}', 'AdminController@updateUserRole');
     
})->middleware('cache');

//================Admin Menus Management Route=========================//
Route::controller(MenuController::class)->middleware('authadmin')->group(function () {
    Route::get('/admin/menu', 'menu')->name('admin.menu');
    Route::get('/admin/create_menu', 'create_menu')->name('admin.create_menu');
    Route::post('/admin/create_menu', 'create_menuPost')->name('admin.create_menu.post');
    Route::get('/admin/update_menu/{id}', 'update_menu')->name('admin.update_menu');
    Route::post('/admin/update_menu/{id}', 'update_menuPost')->name('admin.update_menu.post');
    Route::get('/admin/menu/{id}', 'delete_menu')->name('admin.delete_menu');   
})->middleware('cache');

//================Admin Items Management Route=========================//
Route::controller(ItemController::class)->middleware('authadmin')->group(function () {
    Route::get('/admin/item', 'item')->name('admin.item');
    Route::get('/admin/create_item', 'create_item')->name('admin.create_item');
    Route::post('/admin/create_item', 'create_itemPost')->name('admin.create_item.post');
    Route::get('/admin/update_item/{id}', 'update_item')->name('admin.update_item');
    Route::post('/admin/update_item/{id}', 'update_itemPost')->name('admin.update_item.post');
    Route::get('/admin/item/{id}', 'delete_item')->name('admin.delete_item');
    Route::get('/admin/item', 'filter_item')->name('admin.filter_item');
})->middleware('cache');



//================Admin Orders Management Route=========================//
Route::controller(OrderController::class)->middleware('authadmin')->group(function () {
    Route::get('/admin/order', 'order')->name('admin.order');

    Route::get('/admin/detail_order/{id}', 'detail_order')->name('admin.detail_order');
    Route::post('/admin/detail_order/{id}', 'detail_orderPost')->name('admin.detail_order.post');
    // Route::post('/admin/detail_order/update-order-status', 'updateOrderStatus')->name('admin.detail_order.updateOrderStatus');
    
    Route::post('/admin/update_order/{id}', 'update_orderPost')->name('admin.update_order.post');
    Route::post('/admin/update-order-status', 'updateOrderStatus')->name('admin.updateOrderStatus');
    
    Route::get('/admin/invoice/{id}', 'invoice')->name('admin.invoice');
    Route::get('/admin/order/{id}', 'delete_order')->name('admin.delete_order');   
    Route::get('/admin/invoice_pdf/{id}', 'invoice_pdf')->name('admin.invoice_pdf');
   

    

    // Route::post('admin.performAction', 'order')->name('admin.order');
    // Route::get('/admin/detail_order', 'detail_order') -> name('admin.detail_order');
    // Route::post('/admin/detail_order', 'detail_orderPost')->name('admin.detail_order.post');
    // Route::get('/admin/update_order/{id}', 'update_order')->name('admin.update_order');
    // Route::post('/admin/update_order/{id}', 'update_orderPost')->name('admin.update_order.post');
    // Route::get('/admin/create_order', 'create_order')->name('admin.create_order');
    // Route::post('/admin/create_order', 'create_orderPost')->name('admin.create_order.post');
})->middleware('cache');


//================Admin Suppliers Management Route=========================//
Route::controller(SupplierController::class)->middleware('authadmin')->group(function () {
    Route::get('/admin/supplier', 'supplier')->name('admin.supplier');
    Route::get('/admin/create_supplier', 'create_supplier')->name('admin.create_supplier');
    Route::post('/admin/create_supplier', 'create_supplierPost')->name('admin.create_supplier.post');
    Route::get('/admin/update_supplier/{id}', 'update_supplier')->name('admin.update_supplier');
    Route::post('/admin/update_supplier/{id}', 'update_supplierPost')->name('admin.update_supplier.post');
    Route::get('/admin/supplier/{id}', 'delete_supplier')->name('admin.delete_supplier');   
})->middleware('cache');


//=======================================================================//
//==============================End Admin Route==========================//
//=======================================================================//


//=======================================================================//
//==============================Seller Route Here==========================//
//=======================================================================//

/*============= Seller Auth route ==================*/
Route::controller(AuthSellerController::class)->group(function () {
    Route::get('/seller', 'seller_login')->name('seller_login');
    Route::post('/seller', 'seller_loginPost')->name('seller_login.post');
    Route::get('/seller/logout', 'logout');
})->middleware('cache');

//================Seller Dashboard Route=========================//
    Route::controller(SellerItemController::class)->middleware('authseller')->group(function () {
    Route::get('/seller/item', 'item')->name('item');  
    })->middleware('cache');

//================Seller Management Route=========================//
Route::controller(SellerController::class)->middleware('authseller')->group(function () {
    Route::get('/seller/check_current_password', 'check_current_password');
    Route::match(['get','post'],'/seller/update_password', 'update_password');
    Route::match(['get','post'],'/seller/update_details', 'update_details');  
    })->middleware('cache');

//================Seller Items Management Route=========================//
Route::controller(SellerItemController::class)->middleware('authseller')->group(function () {
    Route::get('/seller/item', 'item')->name('seller.item');
    Route::get('/seller/create_item', 'create_item')->name('seller.create_item');
    Route::post('/seller/create_item', 'create_itemPost')->name('seller.create_item.post');
    Route::get('/seller/update_item/{id}', 'update_item')->name('seller.update_item');
    Route::post('/seller/update_item/{id}', 'update_itemPost')->name('seller.update_item.post');
    Route::get('/seller/item/{id}', 'delete_item')->name('seller.delete_item');
    Route::get('/seller/item', 'filter_item')->name('seller.filter_item'); 
})->middleware('cache');


//================Seller Orders Management Route=========================//
Route::controller(SellerOrderController::class)->middleware('authseller')->group(function () {
    Route::get('/seller/order', 'order')->name('seller.order');

    Route::get('/seller/detail_order/{id}', 'detail_order')->name('seller.detail_order');
    Route::post('/seller/detail_order/{id}', 'detail_orderPost')->name('seller.detail_order.post');
    // Route::post('/admin/detail_order/update-order-status', 'updateOrderStatus')->name('admin.detail_order.updateOrderStatus');
    
    Route::post('/seller/update_order/{id}', 'update_orderPost')->name('seller.update_order.post');
    Route::post('/seller/update-order-status', 'updateOrderStatus')->name('seller.updateOrderStatus');
    
    Route::get('/seller/invoice/{id}', 'invoice')->name('seller.invoice');
    Route::get('/seller/order/{id}', 'delete_order')->name('seller.delete_order');   
    Route::get('/seller/invoice_pdf/{id}', 'invoice_pdf')->name('seller.invoice_pdf');
   
})->middleware('cache');



//=======================================================================//
//==============================Seller Route Here==========================//
//=======================================================================//


//=======================================================================//
//==============================Accountant Route Here==========================//
//=======================================================================//

/*============= Accountant Auth route ==================*/
Route::controller(AuthAccountantController::class)->group(function () {
    Route::get('/accountant', 'accountant_login')->name('accountant_login');
    Route::post('/accountant', 'accountant_loginPost')->name('accountant_login.post');
    Route::get('/accountant/logout', 'logout');
})->middleware('cache');

//================Accountant Dashboard Route=========================//
Route::controller(AccountantDashboardController::class)->middleware('authaccountant')->group(function () {
    Route::get('/accountant/dashboard', 'dashboard')->name('dashboard');  
    })->middleware('cache');

//================Accountant Management Route=========================//
Route::controller(AccountantController::class)->middleware('authaccountant')->group(function () {
    Route::get('/accountant/check_current_password', 'check_current_password');
    Route::match(['get','post'],'/accountant/update_password', 'update_password');
    Route::match(['get','post'],'/accountant/update_details', 'update_details');  
    })->middleware('cache');

//================Accountant Items Management Route=========================//
Route::controller(AccountantItemController::class)->middleware('authaccountant')->group(function () {
    Route::get('/accountant/item', 'item')->name('accountant.item');
    Route::get('/accountant/create_item', 'create_item')->name('accountant.create_item');
    Route::post('/accountant/create_item', 'create_itemPost')->name('accountant.create_item.post');
    Route::get('/accountant/update_item/{id}', 'update_item')->name('accountant.update_item');
    Route::post('/accountant/update_item/{id}', 'update_itemPost')->name('accountant.update_item.post');
    Route::get('/accountant/item/{id}', 'delete_item')->name('accountant.delete_item');
    Route::get('/accountant/item', 'filter_item')->name('accountant.filter_item');
})->middleware('cache');


//================Accountant Orders Management Route=========================//
Route::controller(AccountantOrderController::class)->middleware('authaccountant')->group(function () {
    Route::get('/accountant/order', 'order')->name('accountant.order');

    Route::get('/accountant/detail_order/{id}', 'detail_order')->name('accountant.detail_order');
    Route::post('/accountant/detail_order/{id}', 'detail_orderPost')->name('accountant.detail_order.post');
    // Route::post('/admin/detail_order/update-order-status', 'updateOrderStatus')->name('admin.detail_order.updateOrderStatus');
    
    Route::post('/accountant/update_order/{id}', 'update_orderPost')->name('accountant.update_order.post');
    Route::post('/accountant/update-order-status', 'updateOrderStatus')->name('accountant.updateOrderStatus');
    
    Route::get('/accountant/invoice/{id}', 'invoice')->name('accountant.invoice');
    Route::get('/accountant/order/{id}', 'delete_order')->name('accountant.delete_order');   
    Route::get('/accountant/invoice_pdf/{id}', 'invoice_pdf')->name('accountant.invoice_pdf');
   
})->middleware('cache');


//=======================================================================//
//==============================End Accountant Route==========================//
//=======================================================================//
