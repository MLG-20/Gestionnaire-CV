<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Profile;
use App\Models\Hobby;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HobbyModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function hobby_belongs_to_user()
    {
        $user = User::factory()->create();
        $hobby = Hobby::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $hobby->user);
        $this->assertEquals($user->id, $hobby->user->id);
    }

    #[Test]
    public function hobby_has_name()
    {
        $hobby = Hobby::factory()->create([
            'name' => 'Photography',
        ]);

        $this->assertEquals('Photography', $hobby->name);
    }

    #[Test]
    public function hobby_can_have_sort_order()
    {
        $hobby = Hobby::factory()->create([
            'sort_order' => 2,
        ]);

        $this->assertEquals(2, $hobby->sort_order);
    }

    #[Test]
    public function hobby_sort_order_can_be_zero()
    {
        $hobby = Hobby::factory()->create([
            'sort_order' => 0,
        ]);

        $this->assertEquals(0, $hobby->sort_order);
    }

    #[Test]
    public function user_has_many_hobbies()
    {
        $user = User::factory()->create();
        Hobby::factory(4)->create(['user_id' => $user->id]);

        $this->assertCount(4, $user->hobbies);
    }
}

