<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $attribute = [
            $this->faker->word => $this->faker->word
        ];
        return [
            'name'  => $this->faker->sentence(2, true),
//                'img'   => $faker->image(public_path('images'), 200, 200, null, false),
            'attribute' => $attribute
        ];
    }
}
