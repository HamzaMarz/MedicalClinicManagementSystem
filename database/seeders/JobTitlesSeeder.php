<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobTitlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        DB::table('job_titles')->insert([
            ['name' => 'Department Manager'],
            ['name' => 'Doctor'],
            ['name' => 'Receptionist'],
            ['name' => 'Nurse'],
            ['name' => 'Accountant'],
            ['name' => 'Store Supervisor'],
            // ['name' => 'Security Officer'],
            // ['name' => 'Cleaner'],
        ]);
    }
}
