<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_register(): void
    {
        $response = $this->withoutMiddleware(PreventRequestForgery::class)
            ->post('/student/registration', [
            'first_name' => 'John',
            'last_name' => 'Student',
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/student/login');
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'role' => 'student',
        ]);
    }

    public function test_student_can_login(): void
    {
        $student = User::factory()->student()->create([
            'email' => 'student@example.com',
            'password' => 'password123',
        ]);

        $response = $this->withoutMiddleware(PreventRequestForgery::class)
            ->post('/student/login', [
            'email' => 'student@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/student');
        $this->assertAuthenticatedAs($student);
    }

    public function test_faculty_cannot_access_student_area(): void
    {
        $faculty = User::factory()->faculty()->create();

        $response = $this->actingAs($faculty)->get('/student/courses');

        $response->assertRedirect('/student/login');
    }
}
