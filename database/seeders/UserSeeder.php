<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Intancious',
                'password' => Hash::make('adminhebat'),
                'email' => 'adminhebat@gmail.com',
                'role' => 'admin'
            ],
            [
                'name' => 'resepsionis',
                'password' => Hash::make('resepsionishebat'),
                'email' => 'resepsionishebat@hebat.com',
                'role' => 'guider'
            ]
        ];

        User::insert($data);
    }
}
