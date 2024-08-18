<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'admin',
            'kepala',
            'user1',
            'user2',
            'user3'
        ];

        foreach ($data as $value) {
            Roles::create([
                'roles'     => $value,
                'status'    => 1
            ]);
        }
    }
}
