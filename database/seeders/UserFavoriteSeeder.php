<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserFavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user){
            //attach to user_favorites
            $product = Product::inRandomOrder()->take(rand(1,3))->pluck('id');
            $user->favorites()->attach($product);
        }
    }
}
