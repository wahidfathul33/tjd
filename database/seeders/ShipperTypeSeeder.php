<?php

namespace Database\Seeders;

use App\Models\ShipperType;
use Illuminate\Database\Seeder;

class ShipperTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shipper_type = [
            [
                'title' => 'Instan',
                'description' => 'Estimasi diterima dihari yang sama atau besok'
            ],
            [
                'title' => 'Regular',
                'description' => 'Estimasi diterima 2-5 hari'
            ],
            [
                'title' => 'Kargo',
                'description' => 'Estimasi diterima 2-5 hari'
            ],
            [
                'title' => 'Ekonomi',
                'description' => 'Estimasi diterima 2-5 hari'
            ]
        ];

        for ($i=0; $i < count($shipper_type); $i++) {
            ShipperType::create($shipper_type[$i]);
        }

    }
}
