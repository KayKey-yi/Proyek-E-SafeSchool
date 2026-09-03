<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ReportStatusesTableSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Diproses', 'Selesai', 'Ditolak'] as $statusName) {
            $status = DB::table('report_statuses')->where('status_name', $statusName)->first();

            if ($status) {
                DB::table('report_statuses')->where('id', $status->id)->update(['updated_at' => now()]);
                continue;
            }

            DB::table('report_statuses')->insert([
                'id' => (string) Str::uuid(),
                'status_name' => $statusName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
