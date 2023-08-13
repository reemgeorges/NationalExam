<?php

use App\Http\Controllers\Api\AuthControllerUser;
use App\Http\Controllers\CollageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register',[AuthControllerUser::class, 'register'])->name('register.user');
Route::post('/login', [AuthControllerUser::class, 'login'])->name('login.user');

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthControllerUser::class, 'logout'])->name('logout.user');
    Route::get('/all-collage',[CollageController::class,'index'])->name('all_collage');
})->middleware('throttle:api');
