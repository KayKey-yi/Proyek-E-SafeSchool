<?php

namespace Tests\Feature;

use App\Models\User;
use App\Modules\Complaints\Models\Complaints;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ComplaintDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_their_report_detail_page(): void
    {
        $user = User::factory()->create();

        $statusId = (string) \Illuminate\Support\Str::uuid();
        DB::table('report_statuses')->insert([
            'id' => $statusId,
            'status_name' => 'Diproses',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $complaint = new Complaints();
        $complaint->user_id = $user->id;
        $complaint->status_id = $statusId;
        $complaint->judul = 'Kaca jendela pecah';
        $complaint->deskripsi = "Waktu kejadian: 2026-04-19 09:15\n\nAda anak yang meloncat.";
        $complaint->lokasi = 'T18';
        $complaint->foto = null;
        $complaint->is_anonymous = false;
        $complaint->created_by = $user->id;
        $complaint->save();

        $response = $this->actingAs($user)->get(route('complaints.user.show', $complaint->id));

        $response->assertOk();
        $response->assertSee('Kaca jendela pecah');
        $response->assertSee('T18');
    }
}
