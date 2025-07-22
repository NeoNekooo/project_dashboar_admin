<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Semester;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Semester::create([
            'name' => 'Ganjil',
            'description' => 'Semester 1, 3 dan 5',
            'is_active' => true, // Set Ganjil as active initially, like in your image
        ]);

        Semester::create([
            'name' => 'Genap',
            'description' => 'Semester 2, 4 dan 6',
            'is_active' => false,
        ]);
    }
}