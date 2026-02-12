<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'phone',
        'contact',
        'address',
        'bio',
        'role',
        'employee_id',
        'student_id',
        'guardian_id',
        'user_type',
        'employee_type_id',
        'is_super_admin',
        'date_of_joining',
        'status',
        'login_enabled',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_super_admin' => 'boolean',
            'login_enabled' => 'boolean',
            'date_of_joining' => 'date',
        ];
    }

    /**
     * Get the employee type
     */
    public function employeeType()
    {
        return $this->belongsTo(EmployeeType::class);
    }

    /**
     * Check if user is an employee
     */
    public function isEmployee()
    {
        return $this->user_type === 'employee';
    }

    /**
     * Check if user is a student
     */
    public function isStudent()
    {
        return $this->user_type === 'student';
    }

    /**
     * Check if user is a guardian
     */
    public function isGuardian()
    {
        return $this->user_type === 'guardian';
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin()
    {
        return $this->is_super_admin === true;
    }

    /**
     * Check if user is admin (super admin or admin)
     */
    public function isAdmin()
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($this->isEmployee() && $this->employeeType) {
            return in_array($this->employeeType->code, ['98', '99']);
        }

        return false;
    }

    /**
     * Generate employee ID
     */
    public static function generateEmployeeId($employeeTypeId)
    {
        $employeeType = EmployeeType::findOrFail($employeeTypeId);
        $year = date('Y');
        $serial = $employeeType->getNextSerialNumber();
        
        return 'E' . $year . $employeeType->code . $serial;
    }
}
