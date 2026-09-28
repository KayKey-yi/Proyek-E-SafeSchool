<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER trg_item_reports_preserve_user_id
            BEFORE UPDATE ON item_reports
            FOR EACH ROW
            BEGIN
                SET NEW.user_id = OLD.user_id;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trg_item_reports_preserve_user_id");
    }
};
