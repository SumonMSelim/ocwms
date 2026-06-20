<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FacultyAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_faculty_can_register(): void
    {
        $response = $this->withoutMiddleware(PreventRequestForgery::class)
            ->post('/faculty/registration', [
            'first_name' => 'Jane',
            'last_name' => 'Faculty',
            'email' => 'jane@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/faculty/login');
        $this->assertDatabaseHas('users', [
            'email' => 'jane@example.com',
            'role' => 'faculty',
        ]);
    }

    public function test_faculty_can_login(): void
    {
        $faculty = User::factory()->faculty()->create([
            'email' => 'faculty@example.com',
            'password' => 'password123',
        ]);

        $response = $this->withoutMiddleware(PreventRequestForgery::class)
            ->post('/faculty/login', [
            'email' => 'faculty@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/faculty');
        $this->assertAuthenticatedAs($faculty);
    }

    public function test_student_cannot_access_faculty_area(): void
    {
        $student = User::factory()->student()->create();

        $response = $this->actingAs($student)->get('/faculty/courses');

        $response->assertRedirect('/faculty/login');
    }
}
