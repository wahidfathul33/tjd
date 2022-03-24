<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voucher::factory(10)->create();

        foreach (Voucher::all() as $voucher){
            //attach to voucher_items
            $product = Product::inRandomOrder()->take(rand(1,3))->pluck('id');
            $voucher->items()->attach($product);

            //attach to user_vouchers
            $user = User::where('is_admin', false)
                ->inRandomOrder()
                ->take(rand(1,3))
                ->pluck('id');

            $voucher->users()->attach($user);
        }
    }
}
