<?php


Route::group(['prefix'=>'scms','as'=>'scms.'], function () {
    Route::get('/dashboard', 'Backend\DashboardController@index')->name('dashboard');

    // Student Route
    Route::group(['prefix'=>'student','as'=>'student','controller'=>'Backend\StudentController'], function () {
        getResourceRoute(['create','edit','store','delete']);
        Route::match(['get', 'post'], '/{id?}/{section_id?}', 'index')->name('');
    });

    // Class Route
    Route::group(['prefix'=>'class','as'=>'class','controller'=>'Backend\ClassController'], function () {
        getResourceRoute(['index','edit','store', 'delete']);
    });

    // Section Route
    Route::group(['prefix'=>'section','as'=>'section','controller'=>'Backend\SectionController'], function () {
        getResourceRoute(['create','edit','store', 'delete']);
        Route::match(['get', 'post'], '/{id?}', 'index')->name('');
    });

    // Group Route
    Route::group(['prefix'=>'group','as'=>'group','controller'=>'Backend\GroupController'], function () {
        getResourceRoute(['index','edit','store', 'delete']);
    });

    // Shift Route
    Route::group(['prefix'=>'shift','as'=>'shift','controller'=>'Backend\ShiftController'], function () {
        getResourceRoute(['index','edit','store', 'delete']);
    });
});
