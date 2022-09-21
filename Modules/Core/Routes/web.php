<?php

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

Route::prefix('core')->group(function() {
    Route::controller(Auth\LoginController::class)->group(function () {
        Route::get('/', 'login');
        Route::get('login', 'login');
        Route::post('login', 'store');
        Route::get('logout', 'logout');
    });


    Route::group(['as'=>'core'], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Setting Route
        Route::group(['prefix'=>'settings','as'=>'settings', 'controller'=>'SettingsController'], function () {
            Route::get('/', 'index');
            Route::post('/', 'store')->name('.store');
            Route::match(['get', 'post'], '/logo', 'logo')->name('.logo');
        });
    });

});


Route::get('all/clear', function() {
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('event:clear');
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    dd("Cache is cleared");
});
