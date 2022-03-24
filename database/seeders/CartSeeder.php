<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Variant;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $users = User::where('is_admin', false)->inRandomOrder()->take(10)->pluck('id');
        $product = collect(Product::all()->modelKeys());

        for ($i=0; $i < 30; $i++){
            foreach ($users as $user_id){
                $product_id = $product->random();
                $variant = Variant::where('product_id', $product_id)->first();
                $variant_id = !empty($variant) ? $variant->id : null;

                $data[] = [
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'variant_id' => $variant_id,
                    'qty' => rand(1,5)
                ];
            }
        }

        foreach ($data as $value){
            Cart::create($value);
        }
    }
}
