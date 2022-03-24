<?php

namespace Database\Seeders;

use App\Models\BalanceMutation;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class BalanceMutationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mutations = [];
        foreach (Transaction::all() as $trx){
            $mutations[] = [
                'user_id' => $trx->user_id,
                'transaction_id' => $trx->id,
                //'user_deposit_id' => null,
                'type' => 'D',
                'balance_type' => 'balance',
                'amount' => $trx->amount - ($trx->amount * (20/100)),
                'description' => 'Pembayaran transaksi',
            ];

            $mutations[] = [
                'user_id' => $trx->user_id,
                'transaction_id' => $trx->id,
                //'user_deposit_id' => null,
                'type' => 'D',
                'balance_type' => 'point',
                'amount' => $trx->amount * (20/100),
                'description' => 'Pembayaran transaksi',
            ];
        }

//        $mutations_chunk = array_chunk($mutations, 10);
        foreach ($mutations as $value){
            BalanceMutation::create($value);
        }

    }
}
