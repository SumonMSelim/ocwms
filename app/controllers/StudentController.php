<?php

class StudentController extends \BaseController
{
    public function showHome()
    {
        $data = [];
        $data['page_title'] = 'Student Home';
        $data['courses'] = Course::all();
        return View::make('student.home', $data);
    }

    public function showLogin()
    {
        $data = [];
        $data['page_title'] = 'Student Login';
        return View::make('student.login', $data);
    }

    public function showRegistration()
    {
        $data = [];
        $data['page_title'] = 'Student Registration';
        return View::make('student.registration', $data);
    }

    public function showCourses()
    {
        $data = [];
        $data['page_title'] = 'My Courses';
        $data['courses'] = UC::where('user_id', Session::get('user_id'))->get();
        return View::make('student.courses', $data);
    }

    public function browseCourses()
    {
        $data = [];
        $data['page_title'] = 'Browse Courses';
        $data['courses'] = Course::all();
        return View::make('student.browse', $data);
    }

    public function enrollToCourse($id)
    {
        $data = [
            'user_id' => Session::get('user_id'),
            'course_id' => $id,
        ];
        $enroll = UC::create($data);

        if ($enroll) {
            Session::flash('message', 'Enrolled to course successfully.');
            return Redirect::to('student/courses');
        } else {
            Session::flash('message', 'Something went wrong!');
            return Redirect::to('student/browse');
        }
    }

    public function submitSolution($id)
    {
        $data = [];
        $data['page_title'] = 'Submit Assignment Solution';
        $data['assignment'] = Assignment::find($id);
        return View::make('student.solution', $data);
    }

    public function processSolution($id)
    {
        $rules = [
            'submission_file' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $lecture_file = Input::file('submission_file');
        $filename = str_random(20) . '.' . $lecture_file->getClientOriginalExtension();

        $destinationPath = public_path('uploads/solution_files/');
        $upload_success = $lecture_file->move($destinationPath, $filename);

        $data = [
            'student_id' => Session::get('user_id'),
            'assignment_id' => $id,
            'submission_files' => $filename,
        ];

        $lecture = Submission::create($data);

        if ($lecture) {
            Session::flash('message', 'Solution added successfully.');
            return Redirect::back();
        } else {
            Session::flash('message', 'Sorry. Something went wrong!');
            return Redirect::back();
        }
    }

    public function viewCourse($id)
    {
        $data = [];
        $data['page_title'] = 'View Course Contents';
        $data['course'] = Course::find($id);
        $data['grade'] = UC::where(['course_id'=>$id, 'user_id'=>Session::get('user_id')])->first();
        return View::make('student.course', $data);
    }


    public function editProfile()
    {
        $data = [];
        $data['page_title'] = 'Edit Profile';
        $data['user'] = User::find(Session::get('user_id'));
        return View::make('student.edit_profile', $data);
    }

    public function changePassword()
    {
        $data = [];
        $data['page_title'] = 'Change Password';
        return View::make('student.change_password', $data);
    }

    public function processPassword()
    {
        $rules = [
            'password' => 'required|confirmed|min:6',
        ];

        $messages = array(
            'password.confirmed' => 'Both password should match.',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user = User::find(Session::get('user_id'));
        $user->password = Hash::make(Input::get('password'));

        if ($user->save()) {
            Session::flash('message', 'Password changed successfully.');
            return Redirect::back();
        } else {
            Session::flash('message', 'Sorry. Something went wrong!');
            return Redirect::back();
        }
    }

    public function processProfile()
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user = User::find(Session::get('user_id'));
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');

        if ($user->save()) {
            Session::flash('message', 'Profile updated successfully.');
            return Redirect::back();
        } else {
            Session::flash('message', 'Sorry. Something went wrong!');
            return Redirect::back();
        }
    }

    public function processRegistration()
    {
        $rules = [
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:6',
        ];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        try {
            // Registration Data
            $data = [
                'first_name' => Input::get('first_name'),
                'last_name' => Input::get('last_name'),
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'activated' => true,
            ];

            // Create the user
            $user = Sentry::createUser($data);

            // Find the group
            $userGroup = Sentry::findGroupByName('student');

            // Assign the group to the user
            $user->addGroup($userGroup);

            // Send registration information to the registered user
            Mail::send('emails.auth.registration', $data, function ($message) use ($user) {
                $message->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('[OCW Management System] New Account Registration Successful');
            });

            Session::flash('message', 'Registration successful.');
            return Redirect::to('student/login');
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $message = 'Login field is required.';
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $message = 'Password field is required.';
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            $message = 'User with this login already exists.';
        } catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
            $message = 'Group was not found.';
        }

        Session::flash('message', $message);
        return Redirect::back();
    }

    public function processLogin()
    {
        try {
            // Login credentials
            $credentials = [
                'email' => Input::get('email'),
                'password' => Input::get('password'),
            ];

            if ( ! Input::get('remember')) {
                $user = Sentry::authenticate($credentials);
            } else {
                $user = Sentry::authenticateAndRemember($credentials);
            }

            $student = Sentry::findGroupByName('student');

            if ($user->inGroup($student)) {
                Session::put('user_id', $user->id);
                return Redirect::to('student');
            } else {
                $message = 'You are not authorized to access this page.';
                Session::flash('message', $message);
                return Redirect::to('student/login');
            }

        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $message = 'Login field is required.';
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $message = 'Password field is required.';
        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            $message = 'Wrong password, try again.';
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $message = 'User was not found.';
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            $message = 'User is not activated.';
        } // The following is only required if the throttling is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            $message = 'User is suspended.';
        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            $message = 'User is banned.';
        }

        Session::flash('message', $message);
        return Redirect::back();
    }

    public function processLogout()
    {
        Sentry::logout();
        Session::flash('message', 'Logged out successfully.');
        return Redirect::to('student/login');
    }

}
