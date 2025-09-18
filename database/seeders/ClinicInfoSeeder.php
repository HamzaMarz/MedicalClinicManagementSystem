<?php

namespace Database\Seeders;

use App\Models\ClinicInfo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClinicInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        ClinicInfo::create([
            'name'        => 'Al-ISLAM',
            'email'       => 'info@clinic.com',
            'phone'       => '0592226120',
            'location'    => 'Gaza',
            'work_start'  => '08:00',
            'work_end'    => '22:00',
            'work_days' => ['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday'],
            'description' => 'Our clinic is a specialized medical center dedicated to providing high-quality healthcare services to patients of all ages. We focus on delivering professional medical consultations, preventive care, diagnostic services, and personalized treatment plans. Our mission is to ensure patient safety, comfort, and satisfaction by combining medical expertise with modern technology. The clinic operates throughout the week with flexible working hours, making it easier for patients to receive timely and reliable medical care.'
        ]);
    }
}
