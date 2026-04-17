<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Profile;
use App\Models\Education;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EducationModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function education_belongs_to_user()
    {
        $user = User::factory()->create();
        $education = Education::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $education->user);
        $this->assertEquals($user->id, $education->user->id);
    }

    #[Test]
    public function education_has_school_and_degree()
    {
        $education = Education::factory()->create([
            'school' => 'University of California',
            'degree' => 'Bachelor of Science',
            'field_of_study' => 'Computer Science',
        ]);

        $this->assertEquals('University of California', $education->school);
        $this->assertEquals('Bachelor of Science', $education->degree);
        $this->assertEquals('Computer Science', $education->field_of_study);
    }

    #[Test]
    public function education_has_graduation_year()
    {
        $education = Education::factory()->create([
            'graduation_year' => 2020,
        ]);

        $this->assertEquals(2020, $education->graduation_year);
    }

    #[Test]
    public function education_description_can_be_nullable()
    {
        $education = Education::factory()->create([
            'description' => null,
        ]);

        $this->assertNull($education->description);
    }

    #[Test]
    public function education_has_sort_order()
    {
        $education = Education::factory()->create([
            'sort_order' => 5,
        ]);

        $this->assertEquals(5, $education->sort_order);
    }

    #[Test]
    public function user_has_many_educations()
    {
        $user = User::factory()->create();
        Education::factory(2)->create(['user_id' => $user->id]);

        $this->assertCount(2, $user->educations);
    }
}

