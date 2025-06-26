<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/',[ProjectController::class,'getAllDepartments'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::post('/bookappointment',[ProjectController::class,'bookappointment'])->name('bookappointment')->middleware('auth');

Route::post('/showappointments',[ProjectController::class,'showappointments'])->name('showappointments')->middleware('auth');

Route::get('/mybookings',[ProjectController::class,'mybookings'])->name('mybookings')->middleware('auth');

Route::post('/cancelbooking',[ProjectController::class,'cancelbooking'])->name('cancelbooking');