<?php

namespace Database\Factories;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HobbyFactory extends Factory
{
    protected $model = Hobby::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word(),
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }
}
