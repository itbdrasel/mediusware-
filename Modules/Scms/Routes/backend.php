<?php


//Route::group(['middleware' => ['authx','admin'],'prefix'=>'scms','as'=>'scms.'], function () {
Route::group(['middleware' => ['authx'],'prefix'=>'scms','as'=>'scms.'], function () {
    Route::get('/dashboard', 'Backend\DashboardController@index')->name('dashboard');
    Route::get('/branch-manage/{id}', 'Backend\DashboardController@branchManage')->name('branch_manage');

    // Student Route
    Route::group(['prefix'=>'student','as'=>'student','controller'=>'Backend\StudentController'], function () {
        getResourceRoute(['create','edit','store','delete']);
        Route::get('/show/{id}', 'show')->name('.show');
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

    // Setting Route
    Route::group(['prefix'=>'settings','as'=>'settings','controller'=>'Backend\SettingsController'], function () {
        getResourceRoute(['index','store']);
    });

    // Subject Route
    Route::group(['prefix'=>'subject','as'=>'subject','controller'=>'Backend\SubjectController'], function () {
        getResourceRoute(['create','edit','store','delete']);
        Route::get('/show/{id}', 'show')->name('show');
        Route::match(['get', 'post'], '/{id?}', 'index')->name('');
    });

    // Optional Subject Route
    Route::group(['prefix'=>'optional-subject','as'=>'optional_subject','controller'=>'Backend\optionalSubjectController'], function () {
        getResourceRoute(['index', 'store']);
    });

    // Exam Route
    Route::group(['prefix'=>'exam','as'=>'exam','controller'=>'Backend\ExamController'], function () {
        getResourceRoute(['index','create','edit','store','delete']);
    });

    // Result Publish Route
    Route::group(['prefix'=>'result-publish','as'=>'result_publish','controller'=>'Backend\ResultPublishController'], function () {
        getResourceRoute(['index','edit','store', 'delete']);
    });

    // Class Group Manage Route
    Route::group(['prefix'=>'class-group','as'=>'class_group','controller'=>'Backend\ClassGroupController'], function () {
        getResourceRoute(['index','create','edit','store', 'delete']);
    });

    // Exam Rules Route
    Route::group(['prefix'=>'exam-rules','as'=>'exam-rules','controller'=>'Backend\ExamRulesController'], function () {
        getResourceRoute(['index','edit','store', 'delete']);
    });

    //  Rules Manage Route
    Route::group(['prefix'=>'rules-manage','as'=>'rules-manage','controller'=>'Backend\RulesManageController'], function () {
        getResourceRoute(['index','create','edit','store', 'delete']);
    });

    //  Rule Marks Manage Route
    Route::group(['prefix'=>'rule-marks','as'=>'rule-marks','controller'=>'Backend\RuleMarksController'], function () {
        getResourceRoute(['index','store','edit','delete']);
        Route::match(['get', 'post'], '/create', 'create')->name('.create');

    });

    // Grade Manage Route
    Route::group(['prefix'=>'grade','as'=>'grade','controller'=>'Backend\GradesController'], function () {
        getResourceRoute(['index','create','edit','store','delete']);
    });

    // Exam Mark Manage Route
    Route::group(['prefix'=>'marks','as'=>'marks','controller'=>'Backend\MarksController'], function () {
        getResourceRoute(['index','store']);
        Route::match(['get', 'post'], '/create', 'create')->name('.create');
        Route::post('get-sections-subjects', 'getSectionsSubjects')->name('.get-sections-subjects');
    });

    // Promotion Manage Route
    Route::group(['prefix'=>'promote','as'=>'promote','controller'=>'Backend\PromoteController'], function () {
        getResourceRoute(['index','store']);
        Route::post('get-sections', 'getSections')->name('.get-sections');
    });

    // Marksheet Manage Route
    Route::group(['prefix'=>'marksheet','as'=>'marksheet','controller'=>'Backend\MarksheetController'], function () {
        Route::get('', 'index');
        Route::get('/print', 'marksheet')->name('.print');
    });


});


// Module Route
Route::group(['middleware' => ['authx'], 'prefix'=>'scms/ajax','controller'=>'Backend\AjaxJsonController'], function () {
    Route::post('running-year-change', 'runningYearChange');
    Route::post('class-by-sections', 'classBySections');
});
