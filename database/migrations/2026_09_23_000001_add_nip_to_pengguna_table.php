<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom nip (Nomor Induk Pegawai) untuk akun guru/staff.
     * Nullable karena siswa tidak memiliki NIP.
     * Juga ubah nisn dan nis menjadi nullable agar akun guru bisa dibuat
     * tanpa harus mengisi NISN/NIS.
     */
    public function up(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            if (! Schema::hasColumn('pengguna', 'nip')) {
                $table->string('nip', 20)->nullable()->unique()->after('nisn');
            }
            // Jadikan nisn & nis nullable supaya akun guru tidak wajib isi
            $table->unsignedBigInteger('nisn')->nullable()->change();
            $table->unsignedBigInteger('nis')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            if (Schema::hasColumn('pengguna', 'nip')) {
                $table->dropColumn('nip');
            }
            $table->unsignedBigInteger('nisn')->nullable(false)->change();
            $table->unsignedBigInteger('nis')->nullable(false)->change();
        });
    }
};
