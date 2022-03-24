<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = ['male', 'female'];
        return [
            'gender' => $gender[rand(0,1)],
            'account_type' => 'email',
            'phone_number' => $this->faker->phoneNumber,
            'balance' => 1000 * rand(5,1000),
            'point' => 100 * rand(5,500),
            'avatar' => $this->faker->image(public_path('images'), 200, 200, null, false),
            'longitude' => $this->faker->longitude(-180 ,180),
            'latitude' => $this->faker->latitude(-90, 90),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(20),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
