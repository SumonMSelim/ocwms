<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
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

class StudentController extends Controller
{
    public function showHome(): View
    {
        return view('student.home', [
            'page_title' => 'Student Home',
            'courses' => Course::all(),
        ]);
    }

    public function showLogin(): View
    {
        return view('student.login', ['page_title' => 'Student Login']);
    }

    public function showRegistration(): View
    {
        return view('student.registration', ['page_title' => 'Student Registration']);
    }

    public function showCourses(): View
    {
        return view('student.courses', [
            'page_title' => 'My Courses',
            'courses' => UserCourse::where('user_id', Auth::id())->get(),
        ]);
    }

    public function browseCourses(): View
    {
        return view('student.browse', [
            'page_title' => 'Browse Courses',
            'courses' => Course::all(),
        ]);
    }

    public function enrollToCourse(int $id): RedirectResponse
    {
        UserCourse::create([
            'user_id' => Auth::id(),
            'course_id' => $id,
        ]);

        return redirect('student/courses')->with('message', 'Enrolled to course successfully.');
    }

    public function submitSolution(int $id): View
    {
        return view('student.solution', [
            'page_title' => 'Submit Assignment Solution',
            'assignment' => Assignment::findOrFail($id),
        ]);
    }

    public function processSolution(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'submission_file' => 'required|file',
        ]);

        $file = $request->file('submission_file');
        $filename = Str::random(20).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/solution_files'), $filename);

        Submission::create([
            'student_id' => Auth::id(),
            'assignment_id' => $id,
            'submission_files' => $filename,
        ]);

        return back()->with('message', 'Solution added successfully.');
    }

    public function viewCourse(int $id): View
    {
        return view('student.course', [
            'page_title' => 'View Course Contents',
            'course' => Course::findOrFail($id),
            'grade' => UserCourse::where([
                'course_id' => $id,
                'user_id' => Auth::id(),
            ])->first(),
        ]);
    }

    public function editProfile(): View
    {
        return view('student.edit_profile', [
            'page_title' => 'Edit Profile',
            'user' => Auth::user(),
        ]);
    }

    public function changePassword(): View
    {
        return view('student.change_password', ['page_title' => 'Change Password']);
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
            'role' => 'student',
        ]);

        Mail::send('emails.auth.registration', [
            'email' => $user->email,
            'password' => $validated['password'],
        ], function ($message) use ($user) {
            $message->to($user->email, $user->first_name.' '.$user->last_name)
                ->subject('[OCW Management System] New Account Registration Successful');
        });

        return redirect('student/login')->with('message', 'Registration successful.');
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

            if (Auth::user()->isStudent()) {
                return redirect('student');
            }

            Auth::logout();

            return redirect('student/login')->with('message', 'You are not authorized to access this page.');
        }

        return back()->with('message', 'Wrong password, try again.');
    }

    public function processLogout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('student/login')->with('message', 'Logged out successfully.');
    }
}
