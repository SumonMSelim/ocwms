<?php

namespace Tests\Unit;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_faculty_role_check(): void
    {
        $faculty = User::factory()->faculty()->create();

        $this->assertTrue($faculty->isFaculty());
        $this->assertFalse($faculty->isStudent());
    }

    public function test_student_role_check(): void
    {
        $student = User::factory()->student()->create();

        $this->assertTrue($student->isStudent());
        $this->assertFalse($student->isFaculty());
    }
}
