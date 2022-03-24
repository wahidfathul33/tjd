<?php

namespace Database\Seeders;

use App\Models\Shipper;
use Illuminate\Database\Seeder;

class ShipperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Shipper::factory(10)->create();
        $shipper = [
            [
                'name' => 'Grab',
                'shipper_type_id' => 1,
                'price' => 10000,
                'description' => 'GrabExpress'
            ],
            [
                'name' => 'Gojek',
                'shipper_type_id' => 1,
                'price' => 10000,
                'description' => 'Gosend'
            ],
            [
                'name' => 'JNE',
                'shipper_type_id' => 2,
                'price' => 9000,
                'description' => 'JNE Regular'
            ],
            [
                'name' => 'Wahana',
                'shipper_type_id' => 3,
                'price' => 9000,
                'description' => 'Wahana Kargo'
            ]
        ];

        for ($i=0; $i < count($shipper); $i++) {
            Shipper::create($shipper[$i]);
        }

    }
}
