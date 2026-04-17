<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Profile;
use App\Models\Experience;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProfileModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function profile_belongs_to_user()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $profile->user);
        $this->assertEquals($user->id, $profile->user->id);
    }

    #[Test]
    public function user_has_experiences()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);
        Experience::factory(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->experiences);
    }

    #[Test]
    public function profile_belongs_to_user_with_valid_relationship()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        // Has one user
        $this->assertTrue($profile->user()->exists());
        $this->assertEquals($user->id, $profile->user->id);
    }

    #[Test]
    public function profile_can_have_profession()
    {
        $profile = Profile::factory()->create([
            'profession' => 'Senior Laravel Developer',
        ]);

        $this->assertEquals('Senior Laravel Developer', $profile->profession);
    }

    #[Test]
    public function profile_bio_can_be_nullable()
    {
        $profile = Profile::factory()->create([
            'bio' => null,
        ]);

        $this->assertNull($profile->bio);
    }
}
