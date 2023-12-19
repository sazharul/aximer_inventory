<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');
            $table->text('image')->nullable();
            $table->string('name');
            $table->string('category_id');
            $table->string('company_id');
            $table->string('price');
            $table->string('discount_price')->nullable();
            $table->string('discount_percentage')->nullable();
            $table->string('is_flash_sale')->default(0)->nullable();
            $table->string('status')->default(1)->nullable();
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
        Schema::drop('products');
    }
}
