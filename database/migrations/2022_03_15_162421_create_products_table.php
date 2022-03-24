<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->string('sku');
            $table->json('img')->nullable();
            $table->integer('price');
            $table->integer('qty');
            $table->integer('sold_count');
            $table->integer('view_count');
            $table->boolean('is_active')->nullable()->default(true);
            $table->double('weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->json('attribute')->nullable();
            $table->json('dimension')->nullable();
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
        Schema::dropIfExists('products');
    }
}
