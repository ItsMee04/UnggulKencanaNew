<?php

namespace Database\Seeders;

use App\Models\Employees;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employees::create([
            'name'              =>  'Indra Kusuma',
            'address'           =>  '-',
            'phone'             =>  '-',
            'professions_id'    =>  1,
            'avatar'            =>  'admin.png',
            'status'            =>  1,
        ]);
    }
}
