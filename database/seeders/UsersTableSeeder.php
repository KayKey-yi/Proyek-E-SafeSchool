<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Modules\Users\Models\Users;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'superadmin@mail.com',
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'password' => '12345678',
            ],
            [
                'email' => 'siswa001@esafeschool.test',
                'name' => 'Siswa Satu',
                'username' => 'siswa001',
                'password' => 'siswa001pass',
            ],
            [
                'email' => 'siswa002@esafeschool.test',
                'name' => 'Siswa Dua',
                'username' => 'siswa002',
                'password' => 'siswa002pass',
            ],
            [
                'email' => 'guru001@esafeschool.test',
                'name' => 'Guru Satu',
                'username' => 'guru001',
                'password' => 'guru001pass',
            ],
        ];

        foreach ($users as $user) {
            $record = Users::firstOrNew(['username' => $user['username']]);
            $record->name = $user['name'];
            $record->password = bcrypt($user['password']);

            if (! $record->exists || blank($record->email)) {
                $record->email = $user['email'];
            }

            $record->save();
        }
    }
}
