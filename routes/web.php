<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrdersItemsController;


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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Route::get('/userdash', function () {
//     return view('userdash');
// })->middleware(['auth'])->name('userdash');

// Route::get('/admin/products', function () {
//     return view('admin');
// })->middleware(['auth'])->name('admin');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function() {
    // ADMIN PART
    // Throught this routes we will redirect the user to all the departaments we need.
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

    Route::get('/products', [DashboardController::class, "index"])->name('products');
    // Route::get('/products', [ProductController::class, "index"])->name('products.show');
    Route::get('/categories', [CategoryController::class, "index"])->name('categories');
    Route::get('/orders', [OrdersController::class, "index"])->name('orders');

    Route::get('/categories/create', [CategoryController::class, "create"])->name('categories.create');
    // Route::get('/products/create/{products}', [ProductController::class, "create"])->name('products.create');
    Route::get('/products/create', [ProductController::class, "create"])->name('products.create');

    Route::post('/products/add', [ProductController::class, "add"])->name('add_product');
    Route::post('/products/adding', [ProductController::class, "add"])->name('adding_product');
    Route::post('/categories/adding', [CategoryController::class, "add"])->name('adding_category');
    
    Route::post('/orders/edit', [OrdersController::class, "edit"])->name('editing_order');
    Route::post('/products/edit', [ProductController::class, "edit"])->name('edit_product');
    Route::post('/products/edit', [ProductController::class, "edit"])->name('editing_product');
    Route::post('/categories/edit', [CategoryController::class, "edit"])->name('editing_category');
    

    Route::get('/orders/edit/{order}', [OrdersController::class, "formEdit"])->name('form.edit.orders');
    Route::get('/categories/editing/{category}', [CategoryController::class, "formEdit"])->name('formEdit');
    Route::get('/products/edition/{product}', [ProductController::class, "formEdit"])->name('form.edit.products');

    
    Route::post('/order/delete/{order}', [OrdersController::class, "delete"])->name('delete_order');
    Route::post('/categories/delete/{category}', [CategoryController::class, "delete"])->name('deleting_category');
    Route::post('/products/delete/{product}', [ProductController::class, "delete"])->name('delete_product');

    // USER PART

    Route::get('/televisions', [ProductController::class, "indexTv"])->name('televisions');
    Route::get('/productDetail/{product}', [ProductController::class, "productDetail"])->name('productDetail');
    Route::post('/add/Basket/{productId}', [ProductController::class, "addToBasket"])->name('addtobasket');
    Route::get('/buy/{orderId}', [OrdersController::class, "buy"])->name('buy');
    
    
    Route::get('/basket', [OrdersController::class, "indexBasket"])->name('basket');
    Route::get('/basket/minus/{orderId}/{priceProduct}/{totalPrice}/{productId}/{subOrderId}', [OrdersItemsController::class, "minusOne"])->name('minusOne');
    Route::get('/basket/plus/{orderId}/{priceProduct}/{totalPrice}//{productId}/{subOrderId}', [OrdersItemsController::class, "plusOne"])->name('plusOne');
    Route::get('/basket/delete/{subOrderId}/{priceOfSubOrder}', [OrdersItemsController::class, "delete_subOrder"])->name('delete_subOrder');
    
    
});
// Things we can acces even without been logged in

Route::get('/categoryView/{categoryName}', [DashboardController::class, "categoryView"])->name('categoryView');

require __DIR__.'/auth.php';
