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

// Login routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration routes...
Route::group(['middleware' => \App\Http\Middleware\AllowIfNoUsersExist::class], function () {
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});

// Password reset routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Application routes...
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'WatchersController@index')->name('watchers.index');
    Route::post('/scan', 'WatchersController@scan')->name('watchers.scan');

    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('/users', 'UsersController@store')->name('users.store');
    Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
    Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
    Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');

    Route::get('/{watcher}', 'WatchersController@show')->name('watchers.show');
    Route::get('/{watcher}/watchdog/{watchdog}', 'WatcherDogsController@show')->name('watchers.dogs.show');

    Route::get('/{watcher}/scans', 'WatcherScansController@index')->name('watchers.scans.index');
    Route::post('/{watcher}/scans/start', 'WatcherScansController@start')->name('watchers.scans.start');

    Route::get('/{watcher}/changes', 'WatcherChangesController@index')->name('watchers.changes.index');
    Route::get('/{watcher}/changes/{change}', 'WatcherChangesController@show')->name('watchers.changes.show');

    Route::get('/{watcher}/objects', 'WatcherObjectsController@index')->name('watchers.objects.index');
    Route::get('/{watcher}/objects/{object}', 'WatcherObjectsController@show')->name('watchers.objects.show');

    Route::get('/{watcher}/objects/{object}/changes', 'WatcherObjectsController@changes')->name('watchers.objects.changes');
    Route::get('/{watcher}/objects/{object}/properties', 'WatcherObjectsController@properties')->name('watchers.objects.properties');
    Route::get('/{watcher}/objects/{object}/notifications', 'WatcherObjectsController@notifications')->name('watchers.objects.notifications');
});
