<?php

class FacultyController extends \BaseController
{
    public function showHome()
    {
        $data = [];
        $data['page_title'] = 'Faculty Home';
        return View::make('faculty.home', $data);
    }

    public function showLogin()
    {
        $data = [];
        $data['page_title'] = 'Faculty Login';
        return View::make('faculty.login', $data);
    }

    public function showRegistration()
    {
        $data = [];
        $data['page_title'] = 'Faculty Registration';
        return View::make('faculty.registration', $data);
    }

    public function showCourses()
    {
        $data = [];
        $data['page_title'] = 'Courses';
        $data['courses'] = Course::all();
        return View::make('faculty.courses', $data);
    }

    public function showLectures()
    {
        $data = [];
        $data['page_title'] = 'Lectures';
        $data['lectures'] = Lecture::all();
        return View::make('faculty.lectures', $data);
    }

    public function showAssignments()
    {
        $data = [];
        $data['page_title'] = 'Assignments';
        $data['assignments'] = Assignment::all();
        return View::make('faculty.assignments', $data);
    }

    public function createCourse()
    {
        $data = [];
        $data['page_title'] = 'Add A Course';
        return View::make('faculty.create_course', $data);
    }

    public function processCourse()
    {
        $rules = [
            'course_title' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data = [
            'faculty_id' => Session::get('user_id'),
            'course_title' => Input::get('course_title'),
        ];

        $course = Course::create($data);

        if ($course) {
            Session::flash('message', 'Course added successfully.');
            return Redirect::back();
        } else {
            Session::flash('message', 'Sorry. Something went wrong!');
            return Redirect::back();
        }
    }

    public function createLecture()
    {
        $data = [];
        $data['page_title'] = 'Add A Lecture';
        $data['courses'] = Course::where('faculty_id', Session::get('user_id'))->orderby('id', 'ASC')->lists('course_title', 'id');
        return View::make('faculty.create_lecture', $data);
    }

    public function processLecture()
    {
        $rules = [
            'lecture_title' => 'required',
            'lecture_description' => 'required',
            'lecture_file' => 'required',
            'course_id' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $lecture_file = Input::file('lecture_file');
        $filename = str_random(20) . '.' . $lecture_file->getClientOriginalExtension();

        $destinationPath = public_path('uploads/lecture_files/');
        $upload_success = $lecture_file->move($destinationPath, $filename);

        $data = [
            'course_id' => Input::get('course_id'),
            'lecture_title' => Input::get('lecture_title'),
            'lecture_description' => Input::get('lecture_description'),
            'lecture_files' => $filename,
        ];

        $lecture = Lecture::create($data);

        if ($lecture) {
            Session::flash('message', 'Lecture added successfully.');
            return Redirect::back();
        } else {
            Session::flash('message', 'Sorry. Something went wrong!');
            return Redirect::back();
        }
    }

    public function createAssignment()
    {
        $data = [];
        $data['page_title'] = 'Add An Assignment';
        $data['courses'] = Course::where('faculty_id', Session::get('user_id'))->orderby('id', 'ASC')->lists('course_title', 'id');
        return View::make('faculty.create_assignment', $data);
    }

    public function processAssignment()
    {
        $rules = [
            'assignment_title' => 'required',
            'assignment_description' => 'required',
            'assignment_file' => 'required',
            'course_id' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $lecture_file = Input::file('assignment_file');
        $filename = str_random(20) . '.' . $lecture_file->getClientOriginalExtension();

        $destinationPath = public_path('uploads/assignment_files/');
        $upload_success = $lecture_file->move($destinationPath, $filename);

        $data = [
            'course_id' => Input::get('course_id'),
            'assignment_title' => Input::get('assignment_title'),
            'assignment_description' => Input::get('assignment_description'),
            'assignment_files' => $filename,
        ];

        $lecture = Assignment::create($data);

        if ($lecture) {
            Session::flash('message', 'Assignment added successfully.');
            return Redirect::back();
        } else {
            Session::flash('message', 'Sorry. Something went wrong!');
            return Redirect::back();
        }
    }

    public function viewAssignment($id)
    {
        $data = [];
        $data['page_title'] = 'View Assignment Solutions';
        $data['solutions'] = Submission::where('assignment_id',$id)->get();
        return View::make('faculty.assignment', $data);
    }

    public function viewCourse($id)
    {
        $data = [];
        $data['page_title'] = 'View Course Students';
        $data['students'] = UC::where('course_id',$id)->get();
        return View::make('faculty.course', $data);
    }

    public function processGrade($id)
    {
        $data = [
            'grade'=>Input::get('grade')
        ];
        $grade = UC::where(['course_id'=>$id, 'user_id'=>Input::get('user_id')])
            ->update($data);

        if ($grade) {
            Session::flash('message', 'Grade added successfully.');
            return Redirect::back();
        } else {
            Session::flash('message', 'Sorry. Something went wrong!');
            return Redirect::back();
        }
    }

    public function editProfile()
    {
        $data = [];
        $data['page_title'] = 'Edit Profile';
        $data['user'] = User::find(Session::get('user_id'));
        return View::make('faculty.edit_profile', $data);
    }

    public function changePassword()
    {
        $data = [];
        $data['page_title'] = 'Change Password';
        return View::make('faculty.change_password', $data);
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
            $userGroup = Sentry::findGroupByName('faculty');

            // Assign the group to the user
            $user->addGroup($userGroup);

            // Send registration information to the registered user
            Mail::send('emails.auth.registration', $data, function ($message) use ($user) {
                $message->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('[OCW Management System] New Account Registration Successful');
            });

            Session::flash('message', 'Registration successful.');
            return Redirect::to('faculty/login');
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

            $faculty = Sentry::findGroupByName('faculty');

            if ($user->inGroup($faculty)) {
                Session::put('user_id', $user->id);
                return Redirect::to('faculty');
            } else {
                $message = 'You are not authorized to access this page.';
                Session::flash('message', $message);
                return Redirect::to('faculty/login');
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
        return Redirect::to('faculty/login');
    }

}
