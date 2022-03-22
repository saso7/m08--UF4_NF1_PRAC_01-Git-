<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\shopController;
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

Route::get('/', function () {
    return view('welcome');
    //Per redireccionar directament:
    //redirect('welcome')
});

Route::get('/prova', [CategoryController::class, 'index']);
