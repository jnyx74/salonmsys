<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/aboutus', function () {
    return view('aboutus');
})->middleware(['auth', 'verified'])->name('about-us');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route to display the service creation form
    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');

    // Route to display the list of services
    Route::get('/service/index', [ServiceController::class, 'index'])->name('service.index');

    // Route to store a new service (POST request)
    Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store');

    // Profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
