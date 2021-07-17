<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlendxRouter;
use App\Http\Controllers\BlendxController;

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

// Index
Route::get('/{route}/index/{id?}/{api?}', [BlendxController::class, 'index']);
// Show
Route::get('/{route}/show/{id?}/{api?}', [BlendxController::class, 'show']);

// Homepage Routes
//Route::get('/home/counter', [HomepageController::class, 'counter']);

// Login
Route::post("/login/{role}", [AuthController::class, 'login']);
// Register
Route::post("/register/{role}", [AuthController::class, 'register']);
//// Forget Password
//Route::post("/forget-password", [AuthController::class, 'forget_password']);
//// Reset Password
//Route::post("/reset-password", [AuthController::class, 'reset_password'])->name('password.reset');

// Blendme
//Route::any("/{route}/{action?}/{id?}", [BlendxRouter::class, 'blendme']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});

//Route::group(['middleware' => ['auth:sanctum']], function(){
//
//});
