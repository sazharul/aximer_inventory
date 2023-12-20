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
            $table->integer('supplier_id')->nullable();
            $table->string('price');
            $table->string('stock')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('discount_percentage')->nullable();
            $table->string('is_flash_sale')->default(0)->nullable();
            $table->string('code')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_size')->nullable();
            $table->string('origin')->nullable();
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
