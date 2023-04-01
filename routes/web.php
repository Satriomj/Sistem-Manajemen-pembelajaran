<?php

use App\Http\Controllers\Dashboard\TutorController;
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

Route::redirect('/', 'dashboard');

Auth::routes();

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::view('about', 'about')->name('about');

    Route::as('dashboard.')->group(function () {
        Route::controller(TutorController::class)->prefix('tutor')->as('tutor.')->group(function () {
            Route::get('/')->name('index');
            Route::post('/')->name('store');
            Route::post('{tutor}/detach/{course}', 'detachCourse')->name('detach-course');
        });
    });

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
