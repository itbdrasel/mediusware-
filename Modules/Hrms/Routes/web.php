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

//Route::group(['middleware' => ['admin'],'prefix'=>'hrms','as'=>'hrms.'], function () {
Route::group(['prefix'=>'hrms','as'=>'hrms.'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // Department Route
    Route::group(['prefix'=>'department','as'=>'department','controller'=>'DepartmentController'], function () {
        getResourceRoute(['index','edit','store', 'delete']);
    });

    // Designation Route
    Route::group(['prefix'=>'designation','as'=>'designation','controller'=>'DesignationController'], function () {
        getResourceRoute(['index','edit','store', 'delete']);
    });
});
