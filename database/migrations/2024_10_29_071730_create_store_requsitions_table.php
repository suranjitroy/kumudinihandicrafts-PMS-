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
        Schema::create('store_requsitions', function (Blueprint $table) {
            $table->id();
            $table->date('req_date')->nullable();
            $table->string('store_req_no');
            $table->unsignedBigInteger('section_id');

            $table->foreign('section_id')->references('id')->on('sections')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->integer('is_approve');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_requsitions');
    }
};
