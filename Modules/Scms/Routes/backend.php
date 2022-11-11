<?php
Route::group(['prefix'=>'scms','as'=>'scms.'], function () {
    Route::get('/dashboard', 'Backend\DashboardController@index')->name('dashboard');

    // Group Route
    Route::group(['prefix'=>'group','as'=>'group','controller'=>'Backend\GroupController'], function () {
        getResourceRoute(['index','edit','store', 'delete']);
    });

    // Group Route
    Route::group(['prefix'=>'shift','as'=>'shift','controller'=>'Backend\ShiftController'], function () {
        getResourceRoute(['index','edit','store', 'delete']);
    });
});
