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
        Schema::create('biodatas', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary Key
            $table->uuid('id_user'); // Foreign Key
            $table->string('nama_lengkap');
            $table->string('nomer_induk_warga')->unique();
            $table->string('nomer_induk_keluarga');
            $table->string('kartu_warga')->nullable(); // Nullable
            $table->string('ktp')->nullable(); // Nullable
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Pria', 'Perempuan']); // Boolean untuk Pria/perempuan
            $table->enum('status_pernikahan', ['Belum Kawin', 'Kawin', 'Duda', 'Janda']);
            $table->text('alamat');
            $table->enum('jenis_pekerjaan', [
                'Pedagang',
                'Wiraswasta',
                'Swasta',
                'Karyawan Perusahaan',
                'ASN',
                'TNI',
                'POLRI',
                'Lainnya'
            ])->nullable();
            $table->string('lembaga_instansi')->nullable(); // Nullable
            $table->text('alamat_lembaga_instansi')->nullable(); // Nullable
            $table->timestamps();

            // Relasi Foreign Key
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodatas');
    }
};
