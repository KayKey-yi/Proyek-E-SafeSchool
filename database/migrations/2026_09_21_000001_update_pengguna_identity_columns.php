<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengguna', function (Blueprint $table): void {
            if (Schema::hasColumn('pengguna', 'nisn')) {
                $table->unsignedBigInteger('nisn')->nullable()->change();
            }

            if (Schema::hasColumn('pengguna', 'nis')) {
                $table->unsignedBigInteger('nis')->nullable()->change();
            }

            if (! Schema::hasColumn('pengguna', 'nip')) {
                $table->unsignedBigInteger('nip')->nullable()->unique();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengguna', function (Blueprint $table): void {
            if (Schema::hasColumn('pengguna', 'nip')) {
                $table->dropUnique(['nip']);
                $table->dropColumn('nip');
            }

            if (Schema::hasColumn('pengguna', 'nisn')) {
                $table->unsignedBigInteger('nisn')->nullable(false)->change();
            }

            if (Schema::hasColumn('pengguna', 'nis')) {
                $table->unsignedBigInteger('nis')->nullable(false)->change();
            }
        });
    }
};