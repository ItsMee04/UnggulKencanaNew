<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username'      =>  'indrakusuma',
            'password'      =>  Hash::make('123'),
            'employees_id'  =>  1,
            'roles_id'      =>  1,
            'status'        =>  1,
        ]);
    }
}
