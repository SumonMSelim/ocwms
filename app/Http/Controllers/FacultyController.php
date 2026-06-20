<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Submission;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FacultyController extends Controller
{
    public function showHome(): View
    {
        return view('faculty.home', ['page_title' => 'Faculty Home']);
    }

    public function showLogin(): View
    {
        return view('faculty.login', ['page_title' => 'Faculty Login']);
    }

    public function showRegistration(): View
    {
        return view('faculty.registration', ['page_title' => 'Faculty Registration']);
    }

    public function showCourses(): View
    {
        return view('faculty.courses', [
            'page_title' => 'Courses',
            'courses' => Course::all(),
        ]);
    }

    public function showLectures(): View
    {
        return view('faculty.lectures', [
            'page_title' => 'Lectures',
            'lectures' => Lecture::all(),
        ]);
    }

    public function showAssignments(): View
    {
        return view('faculty.assignments', [
            'page_title' => 'Assignments',
            'assignments' => Assignment::all(),
        ]);
    }

    public function createCourse(): View
    {
        return view('faculty.create_course', ['page_title' => 'Add A Course']);
    }

    public function processCourse(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'course_title' => 'required',
        ]);

        Course::create([
            'faculty_id' => Auth::id(),
            'course_title' => $validated['course_title'],
        ]);

        return back()->with('message', 'Course added successfully.');
    }

    public function createLecture(): View
    {
        return view('faculty.create_lecture', [
            'page_title' => 'Add A Lecture',
            'courses' => Course::where('faculty_id', Auth::id())->orderBy('id')->pluck('course_title', 'id'),
        ]);
    }

    public function processLecture(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'lecture_title' => 'required',
            'lecture_description' => 'required',
            'lecture_file' => 'required|file',
            'course_id' => 'required|exists:courses,id',
        ]);

        $file = $request->file('lecture_file');
        $filename = Str::random(20).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/lecture_files'), $filename);

        Lecture::create([
            'course_id' => $validated['course_id'],
            'lecture_title' => $validated['lecture_title'],
            'lecture_description' => $validated['lecture_description'],
            'lecture_files' => $filename,
        ]);

        return back()->with('message', 'Lecture added successfully.');
    }

    public function createAssignment(): View
    {
        return view('faculty.create_assignment', [
            'page_title' => 'Add An Assignment',
            'courses' => Course::where('faculty_id', Auth::id())->orderBy('id')->pluck('course_title', 'id'),
        ]);
    }

    public function processAssignment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'assignment_title' => 'required',
            'assignment_description' => 'required',
            'assignment_file' => 'required|file',
            'course_id' => 'required|exists:courses,id',
        ]);

        $file = $request->file('assignment_file');
        $filename = Str::random(20).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/assignment_files'), $filename);

        Assignment::create([
            'course_id' => $validated['course_id'],
            'assignment_title' => $validated['assignment_title'],
            'assignment_description' => $validated['assignment_description'],
            'assignment_files' => $filename,
        ]);

        return back()->with('message', 'Assignment added successfully.');
    }

    public function viewAssignment(int $id): View
    {
        return view('faculty.assignment', [
            'page_title' => 'View Assignment Solutions',
            'solutions' => Submission::where('assignment_id', $id)->get(),
        ]);
    }

    public function viewCourse(int $id): View
    {
        return view('faculty.course', [
            'page_title' => 'View Course Students',
            'course_id' => $id,
            'students' => UserCourse::where('course_id', $id)->get(),
        ]);
    }

    public function processGrade(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'grade' => 'required|in:A,B,C,D,F',
            'user_id' => 'required|exists:users,id',
        ]);

        UserCourse::where([
            'course_id' => $id,
            'user_id' => $validated['user_id'],
        ])->update(['grade' => $validated['grade']]);

        return back()->with('message', 'Grade added successfully.');
    }

    public function editProfile(): View
    {
        return view('faculty.edit_profile', [
            'page_title' => 'Edit Profile',
            'user' => Auth::user(),
        ]);
    }

    public function changePassword(): View
    {
        return view('faculty.change_password', ['page_title' => 'Change Password']);
    }

    public function processPassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'password' => 'required|confirmed|min:6',
        ], [
            'password.confirmed' => 'Both password should match.',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($validated['password']);
        $user->save();

        return back()->with('message', 'Password changed successfully.');
    }

    public function processProfile(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $user = Auth::user();
        $user->fill($validated);
        $user->save();

        return back()->with('message', 'Profile updated successfully.');
    }

    public function processRegistration(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'faculty',
        ]);

        Mail::send('emails.auth.registration', [
            'email' => $user->email,
            'password' => $validated['password'],
        ], function ($message) use ($user) {
            $message->to($user->email, $user->first_name.' '.$user->last_name)
                ->subject('[OCW Management System] New Account Registration Successful');
        });

        return redirect('faculty/login')->with('message', 'Registration successful.');
    }

    public function processLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (Auth::user()->isFaculty()) {
                return redirect('faculty');
            }

            Auth::logout();

            return redirect('faculty/login')->with('message', 'You are not authorized to access this page.');
        }

        return back()->with('message', 'Wrong password, try again.');
    }

    public function processLogout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('faculty/login')->with('message', 'Logged out successfully.');
    }
}
