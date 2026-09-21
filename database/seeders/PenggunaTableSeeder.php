<?php

namespace Database\Seeders;

use App\Modules\Pengguna\Models\Pengguna;
use App\Modules\Role\Models\Role;
use Illuminate\Database\Seeder;

class PenggunaTableSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::where('role', 'Siswa')->firstOrFail();
        $pengguna = Pengguna::firstOrNew([
            'email' => 'gunturkhususon@gmail.com',
        ]);

        $pengguna->role_id = $role->id;
        $pengguna->nama = 'Guntur Syahbudi Al Azizi';
        $pengguna->password = 'guntur-test-password';
        $pengguna->nisn = 1000000005;
        $pengguna->nis = 100005;
        $pengguna->jenis_kelamin = 'L';
        $pengguna->kelas = '7C';
        $pengguna->no_hp = '081200000005';
        $pengguna->save();
    }
}
