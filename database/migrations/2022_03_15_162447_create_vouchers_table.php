<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->text('description');
            $table->string('type');
            $table->integer('min_purchase')->nullable()->default(1);
            $table->integer('discount')->nullable()->default(0);
            $table->integer('cashback')->nullable()->default(0);
            $table->double('percentage')->nullable()->default(0);
            $table->text('img')->nullable();
            $table->integer('qty_init')->nullable()->default(0);
            $table->integer('qty_claimed')->nullable()->default(0);
            $table->integer('qty_remaining')->nullable()->default(0);
            $table->integer('qty_used')->nullable()->default(0);
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
        Schema::dropIfExists('vouchers');
    }
}
