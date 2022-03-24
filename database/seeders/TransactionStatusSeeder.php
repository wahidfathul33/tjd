<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;
use App\Models\TransactionStatus;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        foreach (Transaction::all() as $trx) :
            $data[] = [
                'transaction_id' => $trx->id,
                'status' => $trx->status
            ];
        endforeach;

//        $data_chunk = array_chunk($data, 10);
        foreach ($data as $value):
            TransactionStatus::create($value);
        endforeach;
    }
}
