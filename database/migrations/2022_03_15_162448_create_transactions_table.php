<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('user_address_id')->nullable();
            $table->bigInteger('voucher_id')->nullable();
            $table->bigInteger('shipper_id');
            $table->bigInteger("amount");
            $table->bigInteger("discount")->nullable()->default(0);
            $table->bigInteger("point")->nullable()->default(0);
            $table->string("payment_type")->nullable();
            $table->string("status");
            $table->string("inv_no",32);
            $table->string("unique_code",12)->nullable();
            $table->string("shipment_receipt",32);
            $table->string("shipment_weight",32);
            $table->string("shipment_weight_unit",32);
            $table->string("shipment_price",32);
            $table->string("shipment_eta");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
