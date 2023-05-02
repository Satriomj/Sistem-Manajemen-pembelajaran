<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\TutorController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\ModuleController;
use App\Http\Controllers\user\UserHomeController;

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
    Route::get('/index', [App\Http\Controllers\User\UserHomeController::class, 'index'])->name('viewsuser.home');
    Route::get('/course', [App\Http\Controllers\User\CourseUserController::class, 'index'])->name('course');

    Route::as('dashboard.')->group(function () {
        Route::controller(TutorController::class)->prefix('tutor')->as('tutor.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::post('{tutor}/detach/{course}', 'detachCourse')->name('detach-course');
        });

        Route::controller(CourseController::class)->prefix('course')->as('course.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{course}', 'show')->name('show');
            Route::put('/{course}', 'update')->name('update');
            Route::post('/{course}/detach/{tutor}', 'detachTutor')->name('detach-tutor');
        });

        Route::controller(ModuleController::class)->prefix('course/{course}/module')->as('course.module.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::put('/{module}', 'update')->name('update');
        });
    });

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
