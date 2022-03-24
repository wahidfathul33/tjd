<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Variant;
use Faker\Factory;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

//        $product = collect(Product::all()->modelKeys());

        for ($i=0; $i < 10; $i++) {
            $data[] = [
//                'product_id' => $product->random(),
                'product_id' => Product::inRandomOrder()->pluck('id')->random(),
                'name' => $faker->sentence(3, true),
                'sku' => $faker->isbn10,
                'price' => rand(10, 80) * 1000,
                'is_active' => rand(0, 1),
            ];
        }

        foreach ($data as $value){
            Variant::insert($value);
        }
    }
}
