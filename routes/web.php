<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
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
});

Route::group(['prefix'=>'admin' ], function(){
    Route::get('/login',[AdminController::class,'adminLogin']);
    Route::post('/login',[AdminController::class,'adminLoginProcess'])->name('admin.login');
    Route::group(['middleware'=>['admin']],function() {
        Route ::get('/dashboard', [AdminController::class, 'dashboard']) -> name('admin.dashboard');
    });
});
