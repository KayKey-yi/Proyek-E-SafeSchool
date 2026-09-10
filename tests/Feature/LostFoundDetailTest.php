<?php

namespace Tests\Feature;

use App\Models\User;
use App\Modules\Item_reports\Models\Item_reports;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LostFoundDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_their_lost_and_found_detail_page(): void
    {
        $user = User::factory()->create();

        $statusId = (string) \Illuminate\Support\Str::uuid();
        DB::table('report_statuses')->insert([
            'id' => $statusId,
            'status_name' => 'Diproses',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $report = new Item_reports();
        $report->user_id = $user->id;
        $report->status_id = $statusId;
        $report->jenis_laporan = 'Ditemukan';
        $report->nama_barang = 'Kunci Motor Honda';
        $report->kategori_barang = 'Aksesoris';
        $report->merek = 'Honda';
        $report->warna = 'Hitam';
        $report->ciri_ciri = 'Terdapat gantungan kunci pelajar dan satu anak kunci tambahan';
        $report->lokasi = 'Depan Musholla';
        $report->tanggal = '2026-05-12';
        $report->foto = null;
        $report->is_anonymous = false;
        $report->created_by = $user->id;
        $report->save();

        $response = $this->actingAs($user)->get(route('item_reports.user.show', $report->id));

        $response->assertOk();
        $response->assertSee('Kunci Motor Honda');
        $response->assertSee('Depan Musholla');
    }
}
