<?php

namespace Database\Seeders;

use App\Models\BalanceMutation;
use App\Models\User;
use App\Models\UserDeposit;
use Illuminate\Database\Seeder;

class UserDepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $status = ['paid', 'not paid yet'];
        $user = collect(User::where('is_admin', false)->pluck('id'));

        for ($i=0; $i < 50; $i++){
            $data[] = [
                'user_id' => $user->random(),
                'amount' => 20000,
                'unique_code' => rand(100,999),
                'status' => $status[rand(0,1)]
            ];
        }

        foreach ($data as $deposit){
            UserDeposit::create($deposit);
        }

        $mutations = [];
        foreach (UserDeposit::all() as $user_deposit){
            $mutations[] = [
                'user_id' => $user_deposit->user_id,
                'user_deposit_id' => $user_deposit->id,
                //'transaction_id' => null,
                'type' => 'K',
                'balance_type' => 'balance',
                'amount' => $user_deposit->amount - ($user_deposit->amount * (20/100)),
                'description' => 'Top-up',
            ];
        }

//        $mutations_chunk = array_chunk($mutations, 10);
        foreach ($mutations as $value){
            BalanceMutation::create($value);
        }
    }
}
