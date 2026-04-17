<?php

namespace Database\Factories;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    protected $model = Skill::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word(),
            'level' => $this->faker->randomElement(['debutant', 'intermediaire', 'avance', 'expert']),
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }
}
