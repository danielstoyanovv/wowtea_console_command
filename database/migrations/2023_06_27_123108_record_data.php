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
        Schema::create('record_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('file_import_id');
            $table->unsignedBigInteger('record_type_id')->nullable();
            $table->json('data')->nullable();
            $table->foreign('file_import_id')->references('id')->on('file_imports')->onDelete('cascade');
            $table->foreign('record_type_id')->references('id')->on('record_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('record_data');
    }
};

