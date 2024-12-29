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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary Key
            $table->uuid('id_user'); // Foreign Key
            $table->string('prestasi');
            $table->year('tahun');
            $table->enum('tingkat', ['Daerah', 'Provinsi', 'Cabang', 'Nasional', 'Internasional']);
            $table->string('sertifikat_prestasi')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
