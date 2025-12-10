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
        Schema::create('transaksi_pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lowongan');
            $table->string('name', 100);
            $table->enum('gender', ['male', 'female']);
            $table->date('dob');
            $table->string('address', 100);
            $table->string('no_telp', 100);
            $table->string('university', 100);
            $table->string('major', 100);
            $table->decimal('ipk', 3, 2);
            $table->enum('status', ['P', 'A', 'R'])->default('P');
            $table->string('path_cv', 255);
            $table->timestamps();

            $table->foreign('id_lowongan')->references('id')->on('master_lowongans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pendaftarans');
    }
};
