<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\WorkingHourController;
use App\Http\Controllers\AppointmentController;

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

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::controller(AgentController::class)->prefix('agent')->group(function(){

});
Route::controller(CandidateController::class)->prefix('candidate')->group(function(){
    Route::get('create','create')->name('candidate.create');
});
Route::controller(HospitalController::class)->prefix('hospital')->group(function(){

});
Route::controller(WorkingHourController::class)->prefix('workHour')->group(function(){

});
Route::controller(AppointmentController::class)->prefix('appointment')->group(function(){
    Route::get('list','index')->name('appointments.index');
});
