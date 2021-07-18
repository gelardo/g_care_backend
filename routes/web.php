<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlendxController;
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
        Route ::get('/logout', [AdminController::class, 'logout']) -> name('admin.logout');

        Route::get('/{route}/index/{id?}', [BlendxController::class, 'index']);
        Route::get('/{route}/create/{id?}', [BlendxController::class, 'create']);
        Route::get('/{route}/show/{id?}', [BlendxController::class, 'show']);
        Route::get('/{route}/edit/{id?}', [BlendxController::class, 'edit']);
        Route::delete('/{route}/delete/{id?}/', [BlendxController::class, 'delete']);
        Route::post('/{route}/store', [BlendxController::class, 'store']);
        Route::put('/{route}/update/{id?}', [BlendxController::class, 'update']);

        Route::get('/doctors',[AdminController::class,'doctor'])->name('admin.doctor');
    });
});
