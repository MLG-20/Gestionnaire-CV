<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use App\Models\Experience;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExperienceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function user_can_list_experiences()
    {
        $user = User::factory()->create();
        Profile::factory()->create(['user_id' => $user->id]);
        Experience::factory(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/dashboard/experiences');

        $response->assertStatus(200);
    }

    #[Test]
    public function user_can_view_experience_edit_form()
    {
        $user = User::factory()->create();
        Profile::factory()->create(['user_id' => $user->id]);
        $experience = Experience::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get("/dashboard/experiences/{$experience->id}/edit");

        $response->assertStatus(200);
    }

    #[Test]
    public function user_can_create_experience()
    {
        $user = User::factory()->create();
        Profile::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post('/dashboard/experiences', [
            'job_title' => 'Developer',
            'company' => 'Tech Corp',
            'location' => 'New York',
            'start_date' => '2020-01-01',
            'end_date' => '2022-01-01',
            'description' => 'Worked on web applications',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('experiences', [
            'user_id' => $user->id,
            'company' => 'Tech Corp',
        ]);
    }

    #[Test]
    public function user_can_update_experience()
    {
        $user = User::factory()->create();
        Profile::factory()->create(['user_id' => $user->id]);
        $experience = Experience::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put("/dashboard/experiences/{$experience->id}", [
            'job_title' => 'Senior Developer',
            'company' => 'New Corp',
            'location' => 'Boston',
            'start_date' => '2020-01-01',
            'end_date' => '2022-01-01',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('experiences', [
            'id' => $experience->id,
            'company' => 'New Corp',
        ]);
    }

    #[Test]
    public function user_can_delete_experience()
    {
        $user = User::factory()->create();
        Profile::factory()->create(['user_id' => $user->id]);
        $experience = Experience::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete("/dashboard/experiences/{$experience->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('experiences', [
            'id' => $experience->id,
        ]);
    }

    #[Test]
    public function unauthenticated_user_cannot_access_experiences()
    {
        $response = $this->get('/dashboard/experiences');

        $response->assertRedirect('/login');
    }
}

