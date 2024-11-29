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
        Schema::create('pendidikan_terakhirs', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary Key
            $table->uuid('id_user');
            $table->enum('pendidikan_terakhir', [
                '-',
                'SD / Sederajat',
                'SMP / Sederajat',
                'SMA / Sederajat',
                'SMK',
                'DI',
                'D-II',
                'D-III',
                'D-IV / Sarjana',
                'Pasca Sarjana - S2',
                'Pasca Sarjana - S3'
            ]);
            $table->string('jurusan')->nullable();
            $table->year('tahun_lulus')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan_terakhirs');
    }
};
