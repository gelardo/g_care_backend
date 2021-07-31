<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ImageController;
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
// Store
Route::post('/{route}/store/{id?}/{api?}', [BlendxController::class, 'store']);

Route::post('/query/{route}', [BlendxController::class, 'query']);
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
//Temporary Routes
Route::get('/doctor/{speciality_id}',[AuthController::class, 'doctor_with_speciality']);

// Blendme
//Route::any("/{route}/{action?}/{id?}", [BlendxRouter::class, 'blendme']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

//Get Images
    Route::get('/profile-images', [ImageController::class, 'profile_image'])->name('profile-images');
    Route::post('/upload_profile_images', [ImageController::class, 'upload_profile_images']);
    Route::post('/update_profile', [AuthController::class, 'update_profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

//Route::group(['middleware' => ['auth:sanctum']], function(){
//
//});
