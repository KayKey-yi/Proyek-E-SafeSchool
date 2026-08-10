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
        Schema::table('pengguna', function (Blueprint $table) {
            if (!Schema::hasColumn('pengguna', 'created_by')) {
                $table->string('created_by', 36)->nullable()->after('no_hp');
            }
            if (!Schema::hasColumn('pengguna', 'updated_by')) {
                $table->string('updated_by', 36)->nullable()->after('created_by');
            }
            if (!Schema::hasColumn('pengguna', 'deleted_by')) {
                $table->string('deleted_by', 36)->nullable()->after('updated_by');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            if (Schema::hasColumn('pengguna', 'deleted_by')) {
                $table->dropColumn('deleted_by');
            }
            if (Schema::hasColumn('pengguna', 'updated_by')) {
                $table->dropColumn('updated_by');
            }
            if (Schema::hasColumn('pengguna', 'created_by')) {
                $table->dropColumn('created_by');
            }
        });
    }
};
