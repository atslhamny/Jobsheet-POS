<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1,
                'nama' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('12345'),
                'level_id' => 1,
            ],
            [
                'user_id' => 2,
                'nama' => 'Manager',
                'username' => 'manager',
                'password' => Hash::make('12345'),
                'level_id' => 2,
            ],
            [
                'user_id' => 3,
                'nama' => 'Staff/Kasir',
                'username' => 'staff',
                'password' => Hash::make('12345'),
                'level_id' => 3,
            ],
        ];
        DB::table('m_user')->insert($data);
    }
}
