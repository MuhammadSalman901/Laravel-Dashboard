<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ShippersController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\SessionController;

Route::view('/', 'index');

//User Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/user', [UsersController::class, 'index'])
        ->name('user.index');
    Route::get('/user/create', [UsersController::class, 'create'])
        ->name('user.create');
    Route::post('/user', [UsersController::class, 'store'])
        ->name('user.store');
    Route::get('/user/{id}/edit', [UsersController::class, 'edit'])
        ->name('user.edit');
    Route::patch('/user/{id}', [UsersController::class, 'update'])
        ->name('user.update');
    Route::delete('/user/{id}', [UsersController::class, 'destroy'])
        ->name('user.delete');
    Route::get('/user/search', [UsersController::class, 'search'])
        ->name('user.search');
    Route::get('/user/{id}', [UsersController::class, 'show'])
        ->name('user.show');
});


//Customer Routes 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/customer', [CustomersController::class, 'index'])
        ->name('customer.index');
    Route::get('/customer/create', [CustomersController::class, 'create'])
        ->name('customer.create');
    Route::post('/customer', [CustomersController::class, 'store'])
        ->name('customer.store');
    Route::get('/customer/{id}/edit', [CustomersController::class, 'edit'])
        ->name('customer.edit');
    Route::patch('/customer/{id}', [CustomersController::class, 'update'])
        ->name('customer.update');
    Route::delete('/customer/{id}', [CustomersController::class, 'destroy'])
        ->name('customer.delete');
    Route::get('/customer/search', [CustomersController::class, 'search'])
        ->name('customer.search');
    Route::get('/customer/{id}', [CustomersController::class, 'show'])
        ->name('customer.show');
});

//Shipper Routes 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/shipper', [ShippersController::class, 'index'])
        ->name('shipper.index');
    Route::get('/shipper/create', [ShippersController::class, 'create'])
        ->name('shipper.create');
    Route::post('/shipper', [ShippersController::class, 'store'])
        ->name('shipper.store');
    Route::get('/shipper/{id}/edit', [ShippersController::class, 'edit'])
        ->name('shipper.edit');
    Route::patch('/shipper/{id}', [ShippersController::class, 'update'])
        ->name('shipper.update');
    Route::delete('/shipper/{id}', [ShippersController::class, 'destroy'])
        ->name('shipper.delete');
    Route::get('/shipper/search', [ShippersController::class, 'search'])
        ->name('shipper.search');
    Route::get('/shipper/{id}', [ShippersController::class, 'show'])
        ->name('shipper.show');
});

//Supplier Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/supplier', [SuppliersController::class, 'index'])
        ->name('supplier.index');
    Route::get('/supplier/create', [SuppliersController::class, 'create'])
        ->name('supplier.create');
    Route::post('/supplier', [SuppliersController::class, 'store'])
        ->name('supplier.store');
    Route::get('/supplier/{id}/edit', [SuppliersController::class, 'edit'])
        ->name('supplier.edit');
    Route::patch('/supplier/{id}', [SuppliersController::class, 'update'])
        ->name('supplier.update');
    Route::delete('/supplier/{id}', [SuppliersController::class, 'destroy'])
        ->name('supplier.delete');
    Route::get('/supplier/search', [SuppliersController::class, 'search'])
        ->name('supplier.search');
    Route::get('/supplier/{id}', [SuppliersController::class, 'show'])
        ->name('supplier.show');
});


//Category Routes 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/category', [CategoryController::class, 'index'])
        ->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])
        ->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])
        ->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])
        ->name('category.edit');
    Route::patch('/category/{id}', [CategoryController::class, 'update'])
        ->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])
        ->name('category.delete');
    Route::get('/category/search', [CategoryController::class, 'search'])
        ->name('category.search');
    Route::get('/category/{id}', [CategoryController::class, 'show'])
        ->name('category.show');
});

//Product Routes 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/product', [ProductController::class, 'index'])
        ->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])
        ->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])
        ->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])
        ->name('product.edit');
    Route::patch('/product/{id}', [ProductController::class, 'update'])
        ->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])
        ->name('product.delete');
    Route::get('/product/search', [ProductController::class, 'search'])
        ->name('product.search');
    Route::get('/product/{id}', [ProductController::class, 'show'])
        ->name('product.show');
});

// Sales Order Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/sales_order', [SalesOrderController::class, 'index'])
        ->name('sales_order.index');
    Route::get('/sales_order/create', [SalesOrderController::class, 'create'])
        ->name('sales_order.create');
    Route::post('/sales_order', [SalesOrderController::class, 'store'])
        ->name('sales_order.store');
    Route::delete('/sales_order/{id}', [SalesOrderController::class, 'destroy'])
        ->name('sales_order.delete');
    Route::get('/sales_order/search', [SalesOrderController::class, 'search'])
        ->name('sales_order.search');
    Route::get('/sales_order/{id}', [SalesOrderController::class, 'show'])
        ->name('sales_order.show');
});

//Order List Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/order_list', [OrderDetailController::class, 'index'])
        ->name('order_list.index');
    Route::get('/order_list/create/{sales_order_id}', [OrderDetailController::class, 'create'])
        ->name('order_list.create');
    Route::post('/order_list', [OrderDetailController::class, 'store'])
        ->name('order_list.store');
    Route::get('/order_list/search', [OrderDetailController::class, 'search'])
        ->name('order_list.search');
    Route::get('/order_list/{id}', [OrderDetailController::class, 'show'])
        ->name('order_list.show');
});

// Login Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [SessionController::class, 'profile'])->name('profile');
});
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
