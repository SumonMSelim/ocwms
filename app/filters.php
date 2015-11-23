<?php
Route::filter('faculty_auth', function () {
    if (!Sentry::check()) {
        $message = 'You need to login to view this page.';
        Session::flash('message', $message);
        return Redirect::to('faculty/login');
    }

    if(!Sentry::getUser()->getGroups()[0]->name == 'faculty') {
        Sentry::logout();
        $message = 'You are not authorized to access this page.';
        Session::flash('message', $message);
        return Redirect::to('faculty/login');
    }
});

Route::filter('student_auth', function () {
    if (!Sentry::check()) {
        $message = 'You need to login to view this page.';
        Session::flash('message', $message);
        return Redirect::to('student/login');
    }

    if(!Sentry::getUser()->getGroups()[0]->name == 'student') {
        Sentry::logout();
        $message = 'You are not authorized to access this page.';
        Session::flash('message', $message);
        return Redirect::to('student/login');
    }
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
*/

Route::filter('csrf', function () {
    if (Session::token() !== Input::get('_token')) {
        throw new Illuminate\Session\TokenMismatchException;
    }
});
