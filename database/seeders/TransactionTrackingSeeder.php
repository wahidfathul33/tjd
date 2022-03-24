<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Models\TransactionTracking;

class TransactionTrackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $data = [];
        foreach (Transaction::where('status', 'Dikirim')->get() as $trx) :
            $data[] = [
                'transaction_id' => $trx->id,
                'status' => $faker->sentence(2, true),
                'status_detail' => $faker->text(200)
            ];

            $data[] = [
                'transaction_id' => $trx->id,
                'status' => $faker->sentence(2, true),
                'status_detail' => $faker->text(200)
            ];

            $data[] = [
                'transaction_id' => $trx->id,
                'status' => $faker->sentence(2, true),
                'status_detail' => $faker->text(200)
            ];

            $data[] = [
                'transaction_id' => $trx->id,
                'status' => $faker->sentence(2, true),
                'status_detail' => $faker->text(200)
            ];
        endforeach;

//        $data_chunk = array_chunk($data, 10);
        foreach ($data as $value):
            TransactionTracking::create($value);
        endforeach;
    }
}
