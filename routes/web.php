<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HairdresserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Redirect to login page or any other page
})->name('logout');


Route::get('/aboutus', function () {
    return view('aboutus');
})->middleware(['auth', 'verified'])->name('about-us');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route to display the service creation form
    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::get('/service/index', [ServiceController::class, 'index'])->name('service.index');
    Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/service/update/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/service/{service}', [ServiceController::class, 'destroy'])->name('service.destroy');
    Route::get('/get-service-price/{id}', [ServiceController::class, 'getServicePrice'])->name('getServicePrice');
    // Route to display the hairdresser creation form
    Route::get('/hairdresser/create', [HairdresserController::class, 'create'])->name('hairdresser.create');
    Route::get('/hairdresser/index', [HairdresserController::class, 'index'])->name('hairdresser.index');
    Route::get('/hairdresser/edit/{id}', [HairdresserController::class, 'edit'])->name('hairdresser.edit');
    Route::put('/hairdresser/update/{id}', [HairdresserController::class, 'update'])->name('hairdresser.update');
    Route::post('/hairdresser/store', [HairdresserController::class, 'store'])->name('hairdresser.store');
    Route::delete('/hairdresser/{hairdresser}', [HairdresserController::class, 'destroy'])->name('hairdresser.destroy');
    
    // Route to display the appointment creation form
    Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::get('/appointment/index', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('/appointment/edit/{id}', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::put('/appointment/update/{id}', [AppointmentController::class, 'update'])->name('appointment.update');
    Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('check-hairdresser-availability', [AppointmentController::class, 'checkAvailability']);
    Route::get('/appointment/calendar', [AppointmentController::class, 'showCalendar'])->name('appointment.calendar');
    Route::delete('/appointment/{appointment}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');
    Route::get('/get-service-price/{id}', [AppointmentController::class, 'getServicePrice'])->name('getServicePrice');
    Route::put('/appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::get('/appointment/report', [AppointmentController::class, 'report'])->name('appointment.report');


    // Profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
