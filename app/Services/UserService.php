<?php

namespace App\Services;

use App\Models\User;
use App\Models\EmployeeType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * Create a new employee
     */
    public function createEmployee(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Get employee type
            $employeeType = EmployeeType::findOrFail($data['employee_type_id']);
            
            // Generate employee ID
            $employeeId = User::generateEmployeeId($data['employee_type_id']);
            
            // Prepare user data
            $userData = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'username' => $data['username'] ?? $this->generateUsername($data['first_name'], $data['last_name']),
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['contact'] ?? $data['phone'] ?? null,
                'contact' => $data['contact'] ?? $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
                'user_type' => 'employee',
                'employee_type_id' => $data['employee_type_id'],
                'employee_id' => $employeeId,
                'is_super_admin' => false,
                'date_of_joining' => $data['date_of_joining'] ?? now(),
                'status' => 'active',
                'login_enabled' => true,
            ];

            // Create user
            $user = User::create($userData);

            return $user;
        });
    }

    /**
     * Create a new student
     */
    public function createStudent(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Generate student ID
            $studentId = $this->generateStudentId();
            
            // Prepare user data
            $userData = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'username' => $data['username'] ?? $this->generateUsername($data['first_name'], $data['last_name']),
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['contact'] ?? $data['phone'] ?? null,
                'contact' => $data['contact'] ?? $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
                'user_type' => 'student',
                'student_id' => $studentId,
                'status' => 'active',
                'login_enabled' => true,
            ];

            // Create user
            $user = User::create($userData);

            return $user;
        });
    }

    /**
     * Create a new guardian
     */
    public function createGuardian(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Generate guardian ID
            $guardianId = $this->generateGuardianId();
            
            // Prepare user data
            $userData = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'username' => $data['username'] ?? $this->generateUsername($data['first_name'], $data['last_name']),
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['contact'] ?? $data['phone'] ?? null,
                'contact' => $data['contact'] ?? $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
                'user_type' => 'guardian',
                'guardian_id' => $guardianId,
                'status' => 'active',
                'login_enabled' => true,
            ];

            // Create user
            $user = User::create($userData);

            return $user;
        });
    }

    /**
     * Create a regular user
     */
    public function createUser(array $data)
    {
        // Prepare user data
        $userData = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['contact'] ?? null,
            'contact' => $data['contact'] ?? null,
            'user_type' => 'user',
            'status' => 'active',
            'login_enabled' => true,
        ];

        // Create user
        return User::create($userData);
    }

    /**
     * Promote employee to admin
     */
    public function promoteToAdmin(User $user)
    {
        if (!$user->isEmployee()) {
            throw new \Exception('Only employees can be promoted to admin.');
        }

        $adminType = EmployeeType::where('code', '98')->first();
        if (!$adminType) {
            throw new \Exception('Admin employee type not found.');
        }

        // Generate new employee ID for admin
        $newEmployeeId = User::generateEmployeeId($adminType->id);

        $user->update([
            'employee_type_id' => $adminType->id,
            'employee_id' => $newEmployeeId,
        ]);

        return $user;
    }

    /**
     * Generate username from first and last name
     */
    protected function generateUsername($firstName, $lastName)
    {
        $baseUsername = strtolower($firstName . '.' . $lastName);
        $username = $baseUsername;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }

    /**
     * Generate student ID (format: S202601001)
     */
    protected function generateStudentId()
    {
        $year = date('Y');
        $lastStudent = User::where('user_type', 'student')
                          ->where('student_id', 'like', 'S' . $year . '%')
                          ->orderBy('student_id', 'desc')
                          ->first();

        if ($lastStudent) {
            $lastSerial = (int) substr($lastStudent->student_id, -5);
            $serial = str_pad($lastSerial + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $serial = '00001';
        }

        return 'S' . $year . $serial;
    }

    /**
     * Generate guardian ID (format: G202601001)
     */
    protected function generateGuardianId()
    {
        $year = date('Y');
        $lastGuardian = User::where('user_type', 'guardian')
                           ->where('guardian_id', 'like', 'G' . $year . '%')
                           ->orderBy('guardian_id', 'desc')
                           ->first();

        if ($lastGuardian) {
            $lastSerial = (int) substr($lastGuardian->guardian_id, -5);
            $serial = str_pad($lastSerial + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $serial = '00001';
        }

        return 'G' . $year . $serial;
    }
}
