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
        Schema::create('master_lowongans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept_id')->nullable();
            $table->string('posisi', 255);
            $table->integer('quota');
            $table->string('deskripsi', 255);
            $table->timestamps();

            $table->string  ('user_create', 255)->nullable();
            $table->string('user_update', 255)->nullable();

            $table->foreign('dept_id')->references('id')->on('master_departemens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_lowongans');
    }
};
