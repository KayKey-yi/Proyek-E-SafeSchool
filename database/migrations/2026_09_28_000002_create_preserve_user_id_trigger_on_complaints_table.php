<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER trg_complaints_preserve_user_id
            BEFORE UPDATE ON complaints
            FOR EACH ROW
            BEGIN
                SET NEW.user_id = OLD.user_id;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trg_complaints_preserve_user_id");
    }
};
