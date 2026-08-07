<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('role_id', 36);
            $table->string('foto_profil', 255)->nullable();
            $table->string('nama', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->unsignedBigInteger('nisn')->unique();
            $table->unsignedBigInteger('nis')->unique();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('kelas', 20)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('no_hp', 20);

            $table->foreign('role_id')->references('id')->on('role');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
