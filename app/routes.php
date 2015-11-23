<?php
Route::get('/', 'HomeController@showHome');

#### Faculty Routes ####
Route::group(['prefix' => 'faculty'], function () {
    Route::get('registration', 'FacultyController@showRegistration');
    Route::post('registration', 'FacultyController@processRegistration');
    Route::get('login', 'FacultyController@showLogin');
    Route::post('login', 'FacultyController@processLogin');
    Route::get('logout', 'FacultyController@processLogout');

    Route::group(['before'=>'faculty_auth'], function () {
        Route::get('/', 'FacultyController@showHome');
        Route::get('change_password', 'FacultyController@changePassword');
        Route::post('change_password', 'FacultyController@processPassword');
        Route::get('edit_profile', 'FacultyController@editProfile');
        Route::post('edit_profile', 'FacultyController@processProfile');
        Route::get('courses', 'FacultyController@showCourses');
        Route::get('lectures', 'FacultyController@showLectures');
        Route::get('assignments', 'FacultyController@showAssignments');
        Route::get('create_course', 'FacultyController@createCourse');
        Route::post('create_course', 'FacultyController@processCourse');
        Route::get('create_lecture', 'FacultyController@createLecture');
        Route::post('create_lecture', 'FacultyController@processLecture');
        Route::get('create_assignment', 'FacultyController@createAssignment');
        Route::post('create_assignment', 'FacultyController@processAssignment');
        Route::get('assignment/{id}', 'FacultyController@viewAssignment');
        Route::get('course/{id}', 'FacultyController@viewCourse');
        Route::post('course/{id}', 'FacultyController@processGrade');
    });
});

#### Student Routes ####
Route::group(['prefix' => 'student'], function () {
    Route::get('registration', 'StudentController@showRegistration');
    Route::post('registration', 'StudentController@processRegistration');
    Route::get('login', 'StudentController@showLogin');
    Route::post('login', 'StudentController@processLogin');
    Route::get('logout', 'StudentController@processLogout');

    Route::group(['before'=>'student_auth'], function () {
        Route::get('/', 'StudentController@showHome');
        Route::get('edit_profile', 'StudentController@editProfile');
        Route::post('edit_profile', 'StudentController@processProfile');
        Route::get('change_password', 'StudentController@changePassword');
        Route::post('change_password', 'StudentController@processPassword');
        Route::get('browse', 'StudentController@browseCourses');
        Route::get('courses', 'StudentController@showCourses');
        Route::get('enroll/{id}', 'StudentController@enrollToCourse');
        Route::get('course/{id}', 'StudentController@viewCourse');
        Route::get('assignment_submission/{id}', 'StudentController@submitSolution');
        Route::post('assignment_submission/{id}', 'StudentController@processSolution');
    });
});