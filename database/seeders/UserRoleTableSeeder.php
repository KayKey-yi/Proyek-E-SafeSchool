<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Role\Models\Role;
use App\Modules\Users\Models\Users;
use App\Modules\UserRole\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Users::where('email', 'superadmin@mail.com')->firstOrFail();

        foreach ([
            [$superAdmin->id, 'Super Admin'],
            [$superAdmin->id, 'Admin'],
        ] as [$userId, $roleName]) {
            UserRole::firstOrCreate([
                'id_user' => $userId,
                'id_role' => Role::where('role', $roleName)->firstOrFail()->id,
            ]);
        }
    }
}
