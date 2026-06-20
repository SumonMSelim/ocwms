<?php

namespace Tests\Unit;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_course_belongs_to_faculty(): void
    {
        $faculty = User::factory()->faculty()->create();
        $course = Course::factory()->create(['faculty_id' => $faculty->id]);

        $this->assertEquals($faculty->id, $course->faculty->id);
        $this->assertEquals($faculty->id, $course->faculty_id);
    }
}
