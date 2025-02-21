<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\WorkingHourController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin'])->group(function (){

    Route::controller(AdminController::class)->prefix('admin')->group(function (){
        Route::get('logout','AdminLogout')->name('admin.logout');

        Route::get('dashboard','home')->name('admin.dashboard');
        Route::resource('users', AdminController::class);// Generates routes for index, create, store, show, edit, update, destroy
        Route::get('slip','Slip')->name('admin.slip');
    });

    Route::controller(UserController::class)->middleware('role:user')->prefix('user')->name('user.')
        ->group(function(){
            Route::get('dashboard','index')->name('dashboard');
        });

    Route::controller(WorkingHourController::class)->prefix('workHour')->group(function(){

    });

    Route::controller(CandidateController::class)->prefix('candidate')->group(function(){
        Route::get('create','create')->name('candidate.create');
    });

    Route::controller(HospitalController::class)->prefix('hospital')->group(function(){
        // GET /hospital
        Route::get('/', 'index')->name('hospital.index');
        // GET /hospital/create
        Route::get('/create', 'create')->name('hospital.create');
        // POST /hospital
        Route::post('/', 'store')->name('hospital.store');
        // GET /hospital/{id}
        Route::get('/{id}','show')->name('hospital.show');
        // GET /hospital/{id}/edit
        Route::get('/{id}/edit','edit')->name('hospital.edit');
        // PUT/PATCH /hospital/{id}
        Route::put('/{id}', 'update')->name('hospital.update');
        Route::patch('/{id}','update');
        // DELETE /hospital/{id}
        Route::delete('/{id}',  'destroy')->name('hospital.destroy');
    });

    Route::controller(AppointmentController::class)->prefix('appointment')->group(function(){
        Route::get('list','index')->name('appointments.index');
    });

    Route::controller(AgentController::class)->middleware('role:agent')->prefix('agent')->name('agent.')
        ->group(function(){
            Route::get('/', 'index')->name('index');
            // GET /hospital/create
            Route::get('/create', 'create')->name('create');
            // POST /hospital
            Route::post('/', 'store')->name('store');
            // GET /hospital/{id}
            Route::get('/{id}','show')->name('show');
            // GET /hospital/{id}/edit
            Route::get('/{id}/edit','edit')->name('edit');
            // PUT/PATCH /hospital/{id}
            Route::put('/{id}', 'update')->name('update');
            Route::patch('/{id}','update');
            // DELETE /hospital/{id}
            Route::delete('/{id}',  'destroy')->name('destroy');
        });

});





