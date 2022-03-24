<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        $notification = [];
        foreach (User::where('is_admin', false)->get() as $trx){
            $notification[] = [
                'user_id' => rand(2,9),
                'type' => 'info',
                'content' => $faker->sentence(rand(6, 10), true),
                'is_read' => rand(0,1),
            ];

            $notification[] = [
                'user_id' => rand(2,9),
                'type' => 'transaction',
                'content' => $faker->sentence(rand(6, 10), true),
                'is_read' => rand(0,1),
            ];
        }

//        $notification_chunk = array_chunk($notification, 10);
        foreach ($notification as $value){
            Notification::create($value);
        }
    }
}
