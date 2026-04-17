<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\CvSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CvSettingTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_update_cv_settings()
    {
        $user = User::factory()->create();
        $setting = CvSetting::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put('/cv-settings', [
            'theme' => 'dark',
            'template' => 'modern',
            'primary_color' => '#007BFF',
            'show_photo' => true,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('cv_settings', [
            'user_id' => $user->id,
            'theme' => 'dark',
            'template' => 'modern',
        ]);
    }

    #[Test]
    public function user_can_view_cv_settings()
    {
        $user = User::factory()->create();
        $setting = CvSetting::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/cv-settings');

        $response->assertStatus(200);
    }

    #[Test]
    public function cv_setting_primary_color_must_be_valid()
    {
        $user = User::factory()->create();
        $setting = CvSetting::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put('/cv-settings', [
            'primary_color' => '#INVALID',
            'theme' => 'light',
            'template' => 'classic',
        ]);

        // Should validate hex color
    }

    #[Test]
    public function unauthenticated_user_cannot_view_cv_settings()
    {
        $response = $this->get('/cv-settings');

        $response->assertRedirect('/login');
    }

    #[Test]
    public function unauthenticated_user_cannot_update_cv_settings()
    {
        $response = $this->put('/cv-settings', [
            'theme' => 'dark',
        ]);

        $response->assertRedirect('/login');
    }
}
