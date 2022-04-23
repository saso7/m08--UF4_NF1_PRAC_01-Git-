<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Route::get('/userdash', function () {
//     return view('userdash');
// })->middleware(['auth'])->name('userdash');

// Route::get('/admin/products', function () {
//     return view('admin');
// })->middleware(['auth'])->name('admin');

Route::group(['middleware' => ['auth']], function() {
    // Throught this routes we will redirect the user to all the departaments we need.
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

    Route::get('/products', [DashboardController::class, "index"])->name('products');
    // Route::get('/products', [ProductController::class, "index"])->name('products.show');
    Route::get('/categories', [CategoryController::class, "index"])->name('categories');

    Route::get('/categories/create', [CategoryController::class, "create"])->name('categories.create');
    // Route::get('/products/create/{products}', [ProductController::class, "create"])->name('products.create');
    Route::get('/products/create', [ProductController::class, "create"])->name('products.create');

    Route::post('/products/add', [ProductController::class, "add"])->name('add_product');
    Route::post('/products/adding', [ProductController::class, "add"])->name('adding_product');
    Route::post('/categories/adding', [CategoryController::class, "add"])->name('adding_category');
    

    Route::post('/products/edit', [ProductController::class, "edit"])->name('edit_product');
    Route::post('/products/edit', [ProductController::class, "edit"])->name('editing_product');
    Route::post('/categories/edit', [CategoryController::class, "edit"])->name('editing_category');
    
    
    Route::get('/categories/editing/{category}', [CategoryController::class, "formEdit"])->name('formEdit');
    Route::get('/products/edition/{product}', [ProductController::class, "formEdit"])->name('form.edit.products');


    Route::post('/categories/delete/{category}', [CategoryController::class, "delete"])->name('deleting_category');
    Route::post('/products/delete/{product}', [ProductController::class, "delete"])->name('delete_product');
});



require __DIR__.'/auth.php';
