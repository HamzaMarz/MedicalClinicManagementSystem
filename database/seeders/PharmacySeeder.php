<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{

        Pharmacy::create([
            'name'        => 'Clinic Pharmacy',
            'email'       => 'Pharmacy@clinic.com',
            'phone'       => '0567891065',
            'location'    => 'Al-Islam Medical Clinic – Next to Al-Salam Building, Ground Floor',
            'work_start_time'  => '08:00',
            'work_end_time'    => '24:00',
            'working_days' => ['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday'],
            'description' => 'Al-Islam Clinic Pharmacy provides essential medicines and medical supplies with high quality, supervised by a professional pharmacist, ensuring excellent patient service and availability of medications during clinic working hours.'
        ]);
    }
}
