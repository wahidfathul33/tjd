<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
//            UserAddressSeeder::class,
//            UserDepositSeeder::class,
//            CategorySeeder::class,
//            BrandSeeder::class,
//            ProductSeeder::class,
//            VariantSeeder::class,
//            VoucherSeeder::class,
//            CartSeeder::class,
//            ShipperTypeSeeder::class,
//            ShipperSeeder::class,
//
//            TransactionSeeder::class,
//            BalanceMutationSeeder::class,
////            MessageSeeder::class,
//            NotificationSeeder::class,
//            ProductReviewSeeder::class,
//            TransactionItemSeeder::class,
//            TransactionStatusSeeder::class,
//            TransactionTrackingSeeder::class,
        ]);
    }
}
