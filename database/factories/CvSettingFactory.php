<?php

namespace Database\Factories;

use App\Models\CvSetting;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CvSettingFactory extends Factory
{
    protected $model = CvSetting::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'template_name' => $this->faker->randomElement(['classic', 'modern', 'minimal']),
            'primary_color' => $this->faker->hexColor(),
            'secondary_color' => $this->faker->hexColor(),
        ];
    }
}
