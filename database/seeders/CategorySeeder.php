<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        Category::factory(10)->create();

        $data = [];
        $attribute = [
            $faker->word => $faker->word
        ];
        $category = collect(Category::all()->modelKeys());

        for ($i=0; $i < 30; $i++){
            $data[] = [
                'parent_id' => $category->random(),
                'name'  => $faker->sentence(2, true),
                'img'   => $faker->image(public_path('images'), 200, 200, null, false),
                'attribute' => $attribute
            ];
        }

        foreach ($data as $value){
            Category::create($value);
        }
    }
}
