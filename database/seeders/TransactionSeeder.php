<?php

namespace Database\Seeders;

use App\Models\Shipper;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserVoucher;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        $user = collect(User::where('is_admin', false)->pluck('id'));
        $shipper = collect(Shipper::all()->modelKeys());
        $status = ['Menunggu pembayaran', 'Menunggu konfirmasi', 'Diproses', 'Dibatalkan', 'Dikirim', 'Selesai'];

        $transactions = [];

        for ($i=0; $i < 30; $i++) {
            $user_id = $user->random();
            $voucher = collect(UserVoucher::where('user_id', $user_id)->pluck('id'));
            $voucher_id = !$voucher->isEmpty() ? $voucher->random() : null;
            $user_address = collect(UserAddress::where('user_id', $user_id)->pluck('id'));

            $transactions[] = [
                'user_id' => $user_id,
                'user_address_id' => !$user_address->isEmpty() ? $user_address->random() : null,
                'voucher_id' => $voucher_id,
                'shipper_id' => $shipper->random(),
                'amount' => 20000,
                'discount' => 1000,
                'point' => 500,
                'payment_type' => 'Transfer (BCA)',
                'status' => $status[rand(0,5)],
                'inv_no' => $faker->isbn13,
                'unique_code' => rand(100, 999),
                'shipment_receipt' => Str::random(16),
                'shipment_weight' => 1,
                'shipment_weight_unit' => 'kg',
                'shipment_price' => 9000,
                'shipment_eta' => '2 hari',
            ];
        }

        //        $transactions_chunk = array_chunk($transactions, 10);
        foreach ($transactions as $value){
            Transaction::create($value);
        }

    }
}
