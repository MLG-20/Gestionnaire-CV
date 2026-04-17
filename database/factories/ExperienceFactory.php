<?php

namespace Database\Factories;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    protected $model = Experience::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'job_title' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
            'location' => $this->faker->city(),
            'start_date' => $this->faker->dateTimeBetween('-5 years', '-1 years')->format('Y-m-d'),
            'end_date' => $this->faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
            'is_current' => $this->faker->boolean(20),
            'description' => $this->faker->paragraph(),
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }
}
