<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\IntervalController;
use App\Http\Controllers\ProfileController;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
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
    $appointments = Appointment::where('user_id', Auth::user()->id)->take(2)->get();
    return view('dashboard', compact('appointments'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/image', [ProfileController::class, 'store_image'])->name('profile.store_image');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('consultants/{consultant}/interval', [IntervalController::class, 'intervals'])->name('consultants.intervals');
    Route::resource('appointments', AppointmentController::class);
    Route::resource('consultants', ConsultantController::class);
    Route::resource('intervals', IntervalController::class);
});


require __DIR__.'/auth.php';
