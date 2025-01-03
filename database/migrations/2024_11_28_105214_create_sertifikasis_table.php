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
        Schema::create('sertifikasis', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary Key
            $table->uuid('id_user'); // Foreign Key
            $table->string('sertifikasi');
            $table->year('tahun');
            $table->string('penyelenggara');
            $table->enum('tingkat', ['Internasional','Nasional','Provinsi','Daerah','Cabang']);
            $table->string('dokumen_sertifikasi')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikasis');
    }
};
