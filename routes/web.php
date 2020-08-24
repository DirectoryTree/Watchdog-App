<?php

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

use App\Http\Controllers\UsersController;
use App\Http\Controllers\WatchersController;
use App\Http\Controllers\WatcherDogsController;
use App\Http\Controllers\WatcherScansController;
use App\Http\Controllers\WatcherChangesController;
use App\Http\Controllers\WatcherObjectsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\View\Components\WatcherObject;

// Login routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes...
Route::group(['middleware' => \App\Http\Middleware\AllowIfNoUsersExist::class], function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Password reset routes...
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');

// Application routes...
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [WatchersController::class, 'index'])->name('watchers.index');
    Route::post('/scan', [WatchersController::class, 'scan'])->name('watchers.scan');

    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

    Route::get('/{watcher}', [WatchersController::class, 'show'])->name('watchers.show');
    Route::get('/{watcher}/watchdog/{watchdog}', [WatcherDogsController::class, 'show'])->name('watchers.dogs.show');

    Route::get('/{watcher}/scans', [WatcherScansController::class, 'index'])->name('watchers.scans.index');
    Route::post('/{watcher}/scans/start', [WatcherScansController::class, 'start'])->name('watchers.scans.start');

    Route::get('/{watcher}/changes', [WatcherChangesController::class, 'index'])->name('watchers.changes.index');
    Route::get('/{watcher}/changes/{change}', [WatcherChangesController::class, 'show'])->name('watchers.changes.show');

    Route::get('/{watcher}/objects', [WatcherObjectsController::class, 'index'])->name('watchers.objects.index');
    Route::get('/{watcher}/objects/{object}', [WatcherObjectsController::class, 'show'])->name('watchers.objects.show');

    Route::get('/{watcher}/objects/{object}/changes', [WatcherObjectsController::class, 'changes'])->name('watchers.objects.changes');
    Route::get('/{watcher}/objects/{object}/timeline', [WatcherObjectsController::class, 'timeline'])->name('watchers.objects.timeline');
    Route::get('/{watcher}/objects/{object}/properties', [WatcherObjectsController::class, 'properties'])->name('watchers.objects.properties');
    Route::get('/{watcher}/objects/{object}/notifications', [WatcherObjectsController::class, 'notifications'])->name('watchers.objects.notifications');

    Route::group(['prefix' => 'components', 'as' => 'components.'], function () {
        Route::get('/{watcher}/objects/{object}', WatcherObject::class)->name('watchers.objects.tree');
    });
});
