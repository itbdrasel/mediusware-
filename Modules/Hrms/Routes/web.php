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

//Route::group(['middleware' => ['authx','admin'],'prefix'=>'hrms','as'=>'hrms.'], function () {
Route::group(['middleware' => ['authx'],'prefix'=>'hrms','as'=>'hrms.'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // Employee Route
    Route::group(['prefix'=>'employee','as'=>'employee','controller'=>'EmployeeController'], function () {
        getResourceRoute(['index','create','edit','store','show','delete']);
    });

    // Department Route
    Route::group(['prefix'=>'department','as'=>'department','controller'=>'DepartmentController'], function () {
        getResourceRoute(['index','edit','store', 'delete']);
    });

    // Designation Route
    Route::group(['prefix'=>'designation','as'=>'designation','controller'=>'DesignationController'], function () {
        getResourceRoute(['index','edit','store', 'delete']);
    });
});
