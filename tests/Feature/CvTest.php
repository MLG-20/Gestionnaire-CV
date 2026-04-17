<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CvTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_view_cv_preview()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/cv');

        $response->assertStatus(200);
    }

    #[Test]
    public function user_can_preview_cv_with_color()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/cv?color=%23007BFF');

        $response->assertStatus(200);
    }

    #[Test]
    public function user_can_download_cv_as_pdf()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/cv/download');

        // PDF response
        $response->assertStatus(200);
    }

    #[Test]
    public function unauthenticated_user_cannot_view_cv()
    {
        $response = $this->get('/cv');

        $response->assertRedirect('/login');
    }

    #[Test]
    public function unauthenticated_user_cannot_download_cv()
    {
        $response = $this->get('/cv/download');

        $response->assertRedirect('/login');
    }

    #[Test]
    public function rate_limiting_applies_to_cv_download()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        // Try multiple downloads
        for ($i = 0; $i < 11; $i++) {
            $response = $this->actingAs($user)->get('/cv/download');
        }

        // 11th request should be rate limited
        $response->assertStatus(429);
    }
}
