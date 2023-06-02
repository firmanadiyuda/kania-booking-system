<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BusanaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Route::get('/dashboard/busana/buat', function () {
    //     return Inertia::render('Busana/Buat');
    // })->name('dashboard');


    Route::get('/dashboard/busana', [BusanaController::class, 'index'])->name('indexBusana');
    Route::get('/dashboard/busana/buat', [BusanaController::class, 'create'])->name('createFormBusana');
    Route::get('/dashboard/busana/ubah/{id}', [BusanaController::class, 'edit'])->name('editFormBusana');

    Route::get('/dashboard/booking', [BookingController::class, 'index'])->name('indexBooking');
    Route::get('/dashboard/booking/{id}', [BookingController::class, 'dashboardShow'])->name('dashboardShowBooking');

    Route::post('/busana', [BusanaController::class, 'store'])->name('buatBusana');
    Route::post('/busana/ubah', [BusanaController::class, 'update'])->name('ubahBusana');
    Route::delete('/busana/hapus', [BusanaController::class, 'destroy'])->name('hapusBusana');
});

Route::get('/busana', [BusanaController::class, 'busanaList'])->name('busanaList');

Route::get('/booking', [BookingController::class, 'create'])->name('createFormBooking');
Route::get('/booking/{id}', [BookingController::class, 'show'])->name('showBooking');
Route::post('/booking', [BookingController::class, 'store'])->name('buatBooking');

Route::post('/kuitansi', [BookingController::class, 'buatKuitansi'])->name('buatKuitansi');
Route::post('/ubahStatusKuitansi', [BookingController::class, 'ubahStatusKuitansi'])->name('ubahStatusKuitansi');
