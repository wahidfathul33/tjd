<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $img = [
            'img1' => $faker->image(public_path('images'), 200, 200, null, false),
        ];

        $product = collect(Product::all()->modelKeys());
        $user = collect(User::where('is_admin', false)->pluck('id'));

        $data = [];
        for ($i=0; $i < 30; $i++) {
            $data[] = [
                'product_id' => $product->random(),
                'user_id' => $user->random(),
                'rating' => rand(1, 5),
                'content' => $faker->text(200),
                'img' => $img,
                'is_replied' => rand(0, 1)
            ];
        }

        foreach ($data as $value){
            ProductReview::create($value);
        }
    }
}
