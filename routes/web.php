<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlendxController;
use App\Http\Controllers\DoctorAssistantController;
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
        Route::post('/add_doctor_assistant', [AdminController::class, 'add_doctor_assistant'])->name('add_doctor_assistant');
        Route::put('/edit_doctor_assistant', [AdminController::class, 'edit_doctor_assistant'])->name('edit_doctor_assistant');
        Route::get('/{route}/index/{id?}', [BlendxController::class, 'index']);
        Route::get('/{route}/create/{id?}', [BlendxController::class, 'create']);
        Route::get('/{route}/show/{id?}', [BlendxController::class, 'show']);
        Route::get('/{route}/edit/{id?}', [BlendxController::class, 'edit']);
        Route::delete('/{route}/delete/{id?}/', [BlendxController::class, 'delete']);
        Route::post('/{route}/store', [BlendxController::class, 'store']);
        Route::put('/{route}/update/{id?}', [BlendxController::class, 'update']);

    });
});
Route::group(['prefix'=>'doctorassistant' ], function(){
    Route::get('/login',[DoctorAssistantController::class,'doctorAssistantLogin']);
    Route::post('/login',[DoctorAssistantController::class,'doctorAssistantLoginProcess'])->name('doctorassistant.login');
    Route::group(['middleware'=>['doctorassistant']],function() {
        Route::get('/',[DoctorAssistantController::class, 'index']);
        Route ::get('/dashboard', [App\Http\Controllers\DoctorAssistantController::class, 'dashboard'])->name('doctorassistant.dashboard'   );
        Route ::get('/logout', [DoctorAssistantController::class, 'logout']) -> name('doctorassistant.logout');
        Route::get('/{route}/index/{id?}', [BlendxController::class, 'index']);

        Route::get('/{route}/create/{id?}', [BlendxController::class, 'create']);
        Route::get('/{route}/show/{id?}', [BlendxController::class, 'show']);
        Route::get('/{route}/edit/{id?}', [BlendxController::class, 'edit']);
        Route::delete('/{route}/delete/{id?}/', [BlendxController::class, 'delete']);
        Route::post('/{route}/store', [BlendxController::class, 'store']);
        Route::put('/{route}/update/{id?}', [BlendxController::class, 'update']);

    });
});
