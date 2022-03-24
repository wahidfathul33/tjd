<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $discount = [
            [
                'type' => 'discount',
                'discount' => 1000,
                'cashback' => 0,
                'percentage' => 0,
            ],
            [
                'type' => 'cashback',
                'discount' => 0,
                'cashback' => 1000,
                'percentage' => 0,
            ],
            [
                'type' => 'percentage',
                'discount' => 0,
                'cashback' => 0,
                'percentage' => 10,
            ]
        ];

        $data = [
            'name' => $this->faker->sentence(2, true),
            'start_date' => $this->faker->dateTime($max = 'now', $timezone = 'Asia/Jakarta'),
            'end_date' => $this->faker->dateTimeInInterval($startDate = 'now', $interval = '+ 5 days', $timezone = 'Asia/Jakarta'),
            'description' => $this->faker->paragraph(3, true),
            'min_purchase' => 1,
//            'img' => $this->faker->image(public_path('images'), 200, 200, null, false),
            'qty_init' => 10,
            'qty_claimed' => 0,
            'qty_remaining' => 0,
            'qty_used' => 0
        ];

        foreach ($discount[rand(0,2)] as $key => $value){
            $data[$key] = $value;
        }

        return $data;
    }
}
