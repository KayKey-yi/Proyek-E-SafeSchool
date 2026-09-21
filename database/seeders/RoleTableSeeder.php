<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Role\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ([
            ['role' => 'Super Admin', 'level' => 1],
            ['role' => 'Admin', 'level' => 2],
            ['role' => 'Siswa', 'level' => 3],
        ] as $role) {
            Role::updateOrCreate(['role' => $role['role']], $role);
        }
    }
}
