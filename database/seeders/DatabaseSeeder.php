<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Student::factory()->count(50)->create();
        Teacher::factory()->count(50)->create();
    }
}
