<?php

use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'showHome']);

Route::prefix('faculty')->group(function () {
    Route::get('registration', [FacultyController::class, 'showRegistration']);
    Route::post('registration', [FacultyController::class, 'processRegistration']);
    Route::get('login', [FacultyController::class, 'showLogin']);
    Route::post('login', [FacultyController::class, 'processLogin']);
    Route::get('logout', [FacultyController::class, 'processLogout']);

    Route::middleware('faculty')->group(function () {
        Route::get('/', [FacultyController::class, 'showHome']);
        Route::get('change_password', [FacultyController::class, 'changePassword']);
        Route::post('change_password', [FacultyController::class, 'processPassword']);
        Route::get('edit_profile', [FacultyController::class, 'editProfile']);
        Route::post('edit_profile', [FacultyController::class, 'processProfile']);
        Route::get('courses', [FacultyController::class, 'showCourses']);
        Route::get('lectures', [FacultyController::class, 'showLectures']);
        Route::get('assignments', [FacultyController::class, 'showAssignments']);
        Route::get('create_course', [FacultyController::class, 'createCourse']);
        Route::post('create_course', [FacultyController::class, 'processCourse']);
        Route::get('create_lecture', [FacultyController::class, 'createLecture']);
        Route::post('create_lecture', [FacultyController::class, 'processLecture']);
        Route::get('create_assignment', [FacultyController::class, 'createAssignment']);
        Route::post('create_assignment', [FacultyController::class, 'processAssignment']);
        Route::get('assignment/{id}', [FacultyController::class, 'viewAssignment']);
        Route::get('course/{id}', [FacultyController::class, 'viewCourse']);
        Route::post('course/{id}', [FacultyController::class, 'processGrade']);
    });
});

Route::prefix('student')->group(function () {
    Route::get('registration', [StudentController::class, 'showRegistration']);
    Route::post('registration', [StudentController::class, 'processRegistration']);
    Route::get('login', [StudentController::class, 'showLogin']);
    Route::post('login', [StudentController::class, 'processLogin']);
    Route::get('logout', [StudentController::class, 'processLogout']);

    Route::middleware('student')->group(function () {
        Route::get('/', [StudentController::class, 'showHome']);
        Route::get('edit_profile', [StudentController::class, 'editProfile']);
        Route::post('edit_profile', [StudentController::class, 'processProfile']);
        Route::get('change_password', [StudentController::class, 'changePassword']);
        Route::post('change_password', [StudentController::class, 'processPassword']);
        Route::get('browse', [StudentController::class, 'browseCourses']);
        Route::get('courses', [StudentController::class, 'showCourses']);
        Route::get('enroll/{id}', [StudentController::class, 'enrollToCourse']);
        Route::get('course/{id}', [StudentController::class, 'viewCourse']);
        Route::get('assignment_submission/{id}', [StudentController::class, 'submitSolution']);
        Route::post('assignment_submission/{id}', [StudentController::class, 'processSolution']);
    });
});
