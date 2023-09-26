<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PersonalController;
use App\Models\blog;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('index', [BlogController::class, 'index']);

Route::post('create', [BlogController::class, 'store'])->name('create');
Route::get('eran', [BlogController::class, 'create']);
