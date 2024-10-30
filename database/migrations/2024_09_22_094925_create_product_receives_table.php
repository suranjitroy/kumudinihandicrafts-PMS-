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
        Schema::create('product_receives', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('store_category_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('store_id')->references('id')->on('stores')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->foreign('store_category_id')->references('id')->on('store_categories')
            ->cascadeOnUpdate()->restrictOnDelete();
            
            $table->foreign('product_id')->references('id')->on('products')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->longText('description')->nullable();

            $table->unsignedBigInteger('supplier_id');

            $table->foreign('supplier_id')->references('id')->on('suppliers')
            ->cascadeOnUpdate()->restrictOnDelete();


            $table->float('quantity');

            $table->unsignedBigInteger('unit_id');

            $table->foreign('unit_id')->references('id')->on('units')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->float('unit_price');

            $table->float('total');

            $table->longText('purpose')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_receives');
    }
};
