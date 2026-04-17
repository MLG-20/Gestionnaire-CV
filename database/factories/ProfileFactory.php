<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'profession' => $this->faker->jobTitle(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'linkedin_url' => 'https://linkedin.com/in/' . $this->faker->userName(),
            'github_url' => 'https://github.com/' . $this->faker->userName(),
            'website_url' => $this->faker->url(),
            'professional_summary' => $this->faker->paragraph(),
        ];
    }
}
