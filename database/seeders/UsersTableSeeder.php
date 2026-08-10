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
        Users::create([
            'name' => 'Super Admin',
            'nama' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt('12345678'),
            'nisn' => 1,
            'nis' => 1,
            'no_hp' => '08123456789'
        ]);
    }
}
