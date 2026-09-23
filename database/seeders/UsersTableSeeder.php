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
                'nama' => 'Super Admin',
                'nisn' => 1000000001,
                'nis' => 100001,
                'jenis_kelamin' => 'L',
                'kelas' => null,
                'no_hp' => '081200000001',
            ],
            [
                'email' => 'siswa001@esafeschool.test',
                'name' => 'Siswa Satu',
                'username' => 'siswa001',
                'password' => 'siswa001pass',
                'nama' => 'Siswa Satu',
                'nisn' => 1000000002,
                'nis' => 100002,
                'jenis_kelamin' => 'L',
                'kelas' => '7A',
                'no_hp' => '081200000002',
            ],
            [
                'email' => 'siswa002@esafeschool.test',
                'name' => 'Siswa Dua',
                'username' => 'siswa002',
                'password' => 'siswa002pass',
                'nama' => 'Siswa Dua',
                'nisn' => 1000000003,
                'nis' => 100003,
                'jenis_kelamin' => 'P',
                'kelas' => '7B',
                'no_hp' => '081200000003',
            ],
            [
                'email' => 'guru001@esafeschool.test',
                'name' => 'Guru Satu',
                'username' => 'guru001',
                'password' => 'guru001pass',
                'nama' => 'Guru Satu',
                'nisn' => 1000000004,
                'nis' => 100004,
                'jenis_kelamin' => 'L',
                'kelas' => null,
                'no_hp' => '081200000004',
            ],
        ];

        foreach ($users as $user) {
            $record = Users::firstOrNew(['username' => $user['username']]);
            $record->fill([
                'name' => $user['name'],
                'email' => $user['email'],
                'nama' => $user['nama'],
                'nisn' => $user['nisn'],
                'nis' => $user['nis'],
                'jenis_kelamin' => $user['jenis_kelamin'],
                'kelas' => $user['kelas'],
                'no_hp' => $user['no_hp'],
            ]);
            $record->password = bcrypt($user['password']);

            $record->save();
        }
    }
}
