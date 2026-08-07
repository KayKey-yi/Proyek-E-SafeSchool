<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 36);
            $table->string('status_id', 36);
            $table->string('jenis_laporan', 10);
            $table->string('nama_barang', 100);
            $table->string('kategori_barang', 100)->nullable();
            $table->string('merek', 100)->nullable();
            $table->string('warna', 50)->nullable();
            $table->text('ciri_ciri')->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->date('tanggal')->nullable();
            $table->string('foto', 255)->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->timestamp('created_at')->nullable();
            $table->softDeletes();
            $table->string('created_by', 36)->nullable();
            $table->string('updated_by', 36)->nullable();
            $table->string('deleted_by', 36)->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('report_statuses');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_reports');
    }
};
