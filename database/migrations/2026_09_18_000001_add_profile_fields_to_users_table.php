<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'nama')) {
                $table->string('nama', 100)->nullable();
            }

            if (! Schema::hasColumn('users', 'nisn')) {
                $table->unsignedBigInteger('nisn')->nullable()->unique();
            }

            if (! Schema::hasColumn('users', 'nis')) {
                $table->unsignedBigInteger('nis')->nullable()->unique();
            }

            if (! Schema::hasColumn('users', 'jenis_kelamin')) {
                $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            }

            if (! Schema::hasColumn('users', 'kelas')) {
                $table->string('kelas', 20)->nullable();
            }

            if (! Schema::hasColumn('users', 'no_hp')) {
                $table->string('no_hp', 20)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            foreach (['nama', 'nisn', 'nis', 'jenis_kelamin', 'kelas', 'no_hp'] as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};