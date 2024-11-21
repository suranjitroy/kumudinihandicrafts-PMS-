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
        Schema::create('store_requsition_details', function (Blueprint $table) {
            $table->id();
            $table->string('store_req_no');
            $table->unsignedBigInteger('store_requsition_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('store_requsition_id')->references('id')->on('store_requsitions')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->foreign('product_id')->references('id')->on('products')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->foreign('unit_id')->references('id')->on('units')
            ->cascadeOnUpdate()->restrictOnDelete();

            
            $table->foreign('user_id')->references('id')->on('users')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_requsition_details');
    }
};
