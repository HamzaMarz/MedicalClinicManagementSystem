<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void{
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(ClinicInfoSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(SpecialtySeeder::class);
        $this->call(DepartmentSpecialtySeeder::class);
        $this->call(JobTitlesSeeder::class);
        $this->call(PharmacySeeder::class);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '0592226120',
            'address' => 'Gaza',
            'date_of_birth' => '2002-03-13',
            'gender' => 'male',
            'image' => 'assets\img\admin\admin.jpg',
        ]);

        Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $admin->assignRole('admin');
    }
}
