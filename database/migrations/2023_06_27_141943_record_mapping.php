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
        Schema::create('record_mapping', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_type_id');
            $table->integer('start_range');
            $table->integer('end_range');
            $table->integer('length');
            $table->text('description');
            $table->foreign('record_type_id')->references('id')->on('record_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('record_mapping');
    }
};


