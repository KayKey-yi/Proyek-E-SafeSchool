<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['complaints', 'item_reports'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->string('user_id', 36)->nullable()->change();
                $table->string('pengguna_id', 36)->nullable()->after('user_id');
                $table->foreign('pengguna_id')->references('id')->on('pengguna');
            });
        }
    }

    public function down(): void
    {
        foreach (['complaints', 'item_reports'] as $tableName) {
            if (DB::table($tableName)->whereNotNull('pengguna_id')->exists()) {
                throw new RuntimeException("Cannot roll back {$tableName}: pengguna-owned reports still exist.");
            }
        }

        foreach (['complaints', 'item_reports'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropForeign(['pengguna_id']);
                $table->dropColumn('pengguna_id');
                $table->string('user_id', 36)->nullable(false)->change();
            });
        }
    }
};
