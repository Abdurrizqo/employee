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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username', 120)->unique();
            $table->string('password');
            $table->string('nama_user', 240);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_open')->default(false);
            $table->uuid('id_ranting');
            $table->timestamps();

            $table->foreign('id_ranting')->references('id')->on('rantings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
