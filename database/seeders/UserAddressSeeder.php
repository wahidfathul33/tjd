<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        $data = [];
        $user = collect(User::where('is_admin', false)->pluck('id'));

        for ($i=0; $i < 10; $i++){
            $data[] = [
                'user_id' => $user->random(),
                'label' => 'Rumah',
                'phone_number' => $faker->phoneNumber,
                'longitude' => $faker->longitude(-180),
                'latitude' => $faker->latitude(-90),
                'city' => $faker->country,
                'districs' => $faker->city,
                'sub_districs' => $faker->citySuffix,
                'village' => $faker->streetName,
                'zip_code' => $faker->postcode,
                'address_detail' => $faker->streetAddress,
            ];
        }

        foreach ($data as $value){
            UserAddress::create($value);
        }
    }
}
