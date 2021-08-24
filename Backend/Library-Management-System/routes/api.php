<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\BookController;
use App\Http\Controllers\API\V1\BorrowController;
use App\Http\Controllers\API\V1\LoginController;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [LoginController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::get('delete/{id}', [LoginController::class, 'destory']);

//For Normal User
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('books', BookController::class);
    Route::apiResource('borrows', BorrowController::class);
    Route::post('admin/borrows', [BorrowController::class, 'adminDestory']);
    Route::get('lists', [BorrowController::class, 'indexBorrowable']);
    Route::get('user', [LoginController::class, 'user']);
    Route::get('logout', [LoginController::class, 'logout']);
});

//For Admin User
Route::middleware('auth:admins')->group(function(){

});