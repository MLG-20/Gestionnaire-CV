<?php

namespace Database\Factories;

use App\Models\Education;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    protected $model = Education::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'school' => $this->faker->company() . ' University',
            'degree' => $this->faker->randomElement(['Bachelor', 'Master', 'Doctorate', 'Diploma']),
            'field_of_study' => $this->faker->word(),
            'graduation_year' => $this->faker->numberBetween(2010, 2024),
            'description' => $this->faker->paragraph(),
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }
}
