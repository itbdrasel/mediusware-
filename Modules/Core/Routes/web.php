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

    Route::controller(Auth\AuthCredentialController::class)->group(function () {
        Route::get('/', 'login');
        Route::get('login', 'login');
        Route::post('login', 'store');
        Route::get('logout', 'logout');
    });


    Route::group(['as'=>'core'], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Setting Route
        Route::group(['prefix'=>'settings','as'=>'settings', 'controller'=>'SettingsController'], function () {
            getResourceRoute(['index', 'store'], false);
            Route::match(['get', 'post'], '/logo', 'logo')->name('.logo');
        });
    });


    // Module Route
    Route::group(['prefix'=>'module','as'=>'module','controller'=>'ModuleController'], function () {
        getResourceRoute(['index','edit','store', 'delete']);
    });

    // Permission Route
    Route::group(['prefix'=>'permissions','as'=>'permissions','controller'=>'PermissionController'], function () {
        getResourceRoute(['index', 'create','store'], false);
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
