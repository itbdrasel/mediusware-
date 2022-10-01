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


    Route::group(['as'=>'core.'], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Setting Route
        Route::group(['prefix'=>'settings','as'=>'settings', 'controller'=>'SettingsController'], function () {
            getResourceRoute(['index', 'store'], false);
            Route::match(['get', 'post'], '/logo', 'logo')->name('.logo');
        });


        // Module Route
        Route::group(['prefix'=>'module','as'=>'module','controller'=>'ModuleController'], function () {
            getResourceRoute(['index','edit','store', 'delete']);
        });

        // Permission Route
        Route::group(['prefix'=>'permissions','as'=>'permissions','controller'=>'PermissionController'], function () {
            getResourceRoute(['index', 'create','store']);
            Route::match(['get', 'post'],'edit', 'edit')->name('.edit');
            Route::post('update', 'update')->name('.update');
            Route::match(['get', 'post'],'section-edit', 'sectionEdit')->name('.section_edit');
            Route::post('section-update', 'sectionUpdate')->name('.section_update');

            // Ajax route
            Route::post('add-remove', 'addRemove')->name('.ajax_add_remove');
            Route::post('route-remove', 'routeRemove')->name('.ajax_route_remove');
            Route::post('get-sections', 'getSectionsById')->name('.ajax_get_sections');
        });

        // Role Route
        Route::group(['prefix'=>'role','as'=>'role','controller'=>'RoleController'], function () {
            getResourceRoute(['index','create','store','edit']);
        });

        // User Route
        Route::group(['prefix'=>'user','as'=>'user','controller'=>'UserController'], function () {
            getResourceRoute(['index','create','store','edit','show','delete']);
        });

    });



});




// Module Route
Route::group(['prefix'=>'core/ajax','controller'=>'AjaxJsonController'], function () {
    Route::post('route-check', 'routeCheck');
});

Route::controller(Sys\NewAllRoutePermissionController::class)->group(function () {
    Route::get('new-all-route-permission','store');
    Route::get('all-routes', 'getAllRoutes');
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

