<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        $attribute = [
            $faker->word => $faker->word,
            $faker->word => $faker->word,
            $faker->word => $faker->word,
            $faker->word => $faker->word,
            $faker->word => $faker->word,
            $faker->word => $faker->word,
        ];

        $dimension = [
            'lenght' => rand(1,500) * 10,
            'width' => rand(1,500) * 10,
            'height' => rand(1,100) * 10,
        ];

        $img = [
            [
                'img1' => $faker->image(public_path('images'), 700, 700, null, false),
            ],
            [
                'img1' => $faker->image(public_path('images'), 700, 700, null, false),
                'img2' => $faker->image(public_path('images'), 700, 700, null, false),
            ],
            [
                'img1' => $faker->image(public_path('images'), 700, 700, null, false),
                'img2' => $faker->image(public_path('images'), 700, 700, null, false),
                'img3' => $faker->image(public_path('images'), 700, 700, null, false),
            ],
            [
                'img1' => $faker->image(public_path('images'), 700, 700, null, false),
                'img2' => $faker->image(public_path('images'), 700, 700, null, false),
                'img3' => $faker->image(public_path('images'), 700, 700, null, false),
                'img4' => $faker->image(public_path('images'), 700, 700, null, false),
            ],
        ];

        $name = $faker->sentence(2, true);

        $category = collect(Category::whereNotNull('parent_id')->inRandomOrder()->pluck('id'));
        $brand = collect(Brand::all()->modelKeys());

        for ($i=0; $i < 10; $i++) {
            $data[] = [
                'category_id' => $category->random(),
                'brand_id' => $brand->random(),
                'name' => $name,
                'slug' => Str::slug($name),
                'sku' => $faker->isbn10,
//                'img' => $img[rand(0, 3)],
                'price' => rand(2, 99) * 1000,
                'qty' => rand(1, 200),
                'sold_count' => rand(1, 123),
                'view_count' => rand(1, 123),
                'is_active' => rand(0, 1),
                'weight' => rand(1, 2),
                'weight_unit' => 'kg',
                'attribute' => $attribute,
                'dimension' => $dimension
            ];
        }

        foreach ($data as $value){
            Product::create($value);
        }
    }
}
