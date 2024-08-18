<?php

namespace Database\Seeders;

use App\Models\Professions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Admin',
            'Kepala',
            'Karyawan'
        ];

        foreach ($data as $value) {
            Professions::create([
                'professions'   => $value,
                'status'        => 1
            ]);
        }
    }
}
