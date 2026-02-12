<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\EmployeeType;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if super admin already exists
        $existingSuperAdmin = User::where('is_super_admin', true)->first();
        
        if ($existingSuperAdmin) {
            $this->command->info('Super Admin already exists!');
            return;
        }

        // Get Super Admin employee type
        $superAdminType = EmployeeType::where('code', '99')->first();
        
        if (!$superAdminType) {
            $this->command->error('Super Admin employee type not found!');
            return;
        }

        // Generate Super Admin employee ID
        $year = date('Y');
        $employeeId = 'E' . $year . '99001'; // First super admin

        // Create Super Admin
        $superAdmin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@spotlight.com',
            'password' => Hash::make('password'), // Change this in production
            'phone' => '1234567890',
            'contact' => '1234567890',
            'user_type' => 'employee',
            'employee_type_id' => $superAdminType->id,
            'employee_id' => $employeeId,
            'is_super_admin' => true,
            'date_of_joining' => now(),
            'status' => 'active',
            'login_enabled' => true,
        ]);

        $this->command->info('Super Admin created successfully!');
        $this->command->info('Email: superadmin@spotlight.com');
        $this->command->info('Password: password');
        $this->command->info('Employee ID: ' . $employeeId);
    }
}
