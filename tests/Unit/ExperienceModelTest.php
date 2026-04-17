<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Profile;
use App\Models\Experience;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExperienceModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function experience_belongs_to_user()
    {
        $user = User::factory()->create();
        $experience = Experience::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $experience->user);
        $this->assertEquals($user->id, $experience->user->id);
    }

    #[Test]
    public function experience_has_company_and_job_title()
    {
        $experience = Experience::factory()->create([
            'company' => 'Tech Company Inc',
            'job_title' => 'Senior Developer',
        ]);

        $this->assertEquals('Tech Company Inc', $experience->company);
        $this->assertEquals('Senior Developer', $experience->job_title);
    }

    #[Test]
    public function experience_has_start_and_end_date()
    {
        $start = now()->subYears(2)->format('Y-m-d');
        $end = now()->format('Y-m-d');

        $experience = Experience::factory()->create([
            'start_date' => $start,
            'end_date' => $end,
        ]);

        $this->assertEquals($start, $experience->start_date->format('Y-m-d'));
        $this->assertEquals($end, $experience->end_date->format('Y-m-d'));
    }

    #[Test]
    public function experience_description_can_be_nullable()
    {
        $experience = Experience::factory()->create([
            'description' => null,
        ]);

        $this->assertNull($experience->description);
    }

    #[Test]
    public function experience_has_location_and_is_current()
    {
        $experience = Experience::factory()->create([
            'location' => 'New York, NY',
            'is_current' => true,
        ]);

        $this->assertEquals('New York, NY', $experience->location);
        $this->assertTrue($experience->is_current);
    }

    #[Test]
    public function user_has_many_experiences()
    {
        $user = User::factory()->create();
        Experience::factory(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->experiences);
    }
}

