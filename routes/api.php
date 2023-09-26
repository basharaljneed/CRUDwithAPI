<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PersonalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [PersonalController::class, 'register']);
Route::post('login', [PersonalController::class, 'login'])->name('login');


Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::get('logout', [PersonalController::class, 'logout'])->name('logout');
    Route::get('indshow', [BlogController::class, 'index']);
    Route::post('create', [BlogController::class, 'store']);
    Route::post('update/{id}', [BlogController::class, 'update']);
    Route::get('destroy/{id}', [BlogController::class, 'destroy']);
});

