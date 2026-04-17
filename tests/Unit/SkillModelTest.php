<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SkillModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function skill_belongs_to_user()
    {
        $user = User::factory()->create();
        $skill = Skill::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $skill->user);
        $this->assertEquals($user->id, $skill->user->id);
    }

    #[Test]
    public function skill_can_have_name_and_level()
    {
        $skill = Skill::factory()->create([
            'name' => 'Laravel',
            'level' => 'expert',
        ]);

        $this->assertEquals('Laravel', $skill->name);
        $this->assertEquals('expert', $skill->level);
    }

    #[Test]
    public function skill_can_have_sort_order()
    {
        $skill = Skill::factory()->create([
            'sort_order' => 3,
        ]);

        $this->assertEquals(3, $skill->sort_order);
    }

    #[Test]
    public function skill_level_can_be_various_values()
    {
        $levels = ['debutant', 'intermediaire', 'avance', 'expert'];
        
        foreach ($levels as $level) {
            $skill = Skill::factory()->create(['level' => $level]);
            $this->assertEquals($level, $skill->level);
        }
    }

    #[Test]
    public function user_has_many_skills()
    {
        $user = User::factory()->create();
        Skill::factory(5)->create(['user_id' => $user->id]);

        $this->assertCount(5, $user->skills);
    }
}

