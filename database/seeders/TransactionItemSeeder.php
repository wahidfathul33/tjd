<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Variant;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TransactionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $products = Product::inRandomOrder()->take(rand(1,3))->pluck('id');
        $data = [];
        foreach (Transaction::all() as $trx) :
            foreach ($products as $product) :
                $variant = collect(Variant::where('product_id', $product)->pluck('id'));

                $data[] = [
                    'transaction_id' => $trx->id,
                    'product_id' => $product,
                    'variant_id' => !$variant->isEmpty() ? $variant->random() : null,
                    'qty' => rand(1,10),
                    'note' => $faker->text(200),
                ];
            endforeach;
        endforeach;

//        $data_chunk = array_chunk($data, 10);
        foreach ($data as $value){
            TransactionItem::create($value);
        }
    }
}
