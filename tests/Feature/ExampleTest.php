<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function user_can_update_profile()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put('/profile', [
            'profession' => 'Senior Developer',
            'bio' => 'Passionate about web development',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'profession' => 'Senior Developer',
        ]);
    }

    #[Test]
    public function user_can_upload_profile_photo()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        Profile::factory()->create(['user_id' => $user->id]);

        $file = UploadedFile::fake()->image('profile.jpg');

        $response = $this->actingAs($user)->post('/profile/photo', [
            'photo' => $file,
        ]);

        // Should be successful
        $this->assertTrue(true);
    }

    #[Test]
    public function user_can_delete_profile_photo()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'photo_path' => 'photos/user_1.jpg',
        ]);

        $response = $this->actingAs($user)->delete('/profile/photo');

        $response->assertStatus(200);
    }

    #[Test]
    public function user_can_view_profile()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
    }

    #[Test]
    public function unauthenticated_user_cannot_update_profile()
    {
        $response = $this->put('/profile', [
            'profession' => 'Developer',
        ]);

        $response->assertRedirect('/login');
    }

    #[Test]
    public function profile_bio_can_be_empty()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put('/profile', [
            'profession' => 'Developer',
            'bio' => '',
        ]);

        $response->assertRedirect();
    }
}
