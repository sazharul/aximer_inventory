<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->double('total_amounts')->nullable();
            $table->integer('discounts')->nullable();
            $table->double('paid_amounts')->nullable();
            $table->double('due_amounts')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('purchase_id')->nullable();
            $table->enum('status',['cash','paid','due'])->default('paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
