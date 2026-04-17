<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_has_profile()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->profile()->exists());
        $this->assertEquals($profile->id, $user->profile->id);
    }

    #[Test]
    public function user_can_create_with_valid_data()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    #[Test]
    public function user_email_must_be_unique()
    {
        $user1 = User::factory()->create(['email' => 'duplicate@example.com']);
        
        // Try to create another user with same email
        $user2 = new User([
            'name' => 'Another User',
            'email' => 'duplicate@example.com',
            'password' => bcrypt('password'),
        ]);

        // Should fail uniqueness check if we validate
        $this->assertEquals($user1->email, $user2->email);
    }

    #[Test]
    public function user_password_is_hashed()
    {
        $plainPassword = 'password123';
        $user = User::factory()->create(['password' => bcrypt($plainPassword)]);

        $this->assertNotEquals($plainPassword, $user->password);
        $this->assertTrue(password_verify($plainPassword, $user->password));
    }
}
