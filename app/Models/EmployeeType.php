<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeType extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all employees of this type
     */
    public function employees()
    {
        return $this->hasMany(User::class, 'employee_type_id')
                    ->where('user_type', 'employee');
    }

    /**
     * Get the next serial number for this employee type
     */
    public function getNextSerialNumber()
    {
        $year = date('Y');
        $lastEmployee = User::where('user_type', 'employee')
                           ->where('employee_type_id', $this->id)
                           ->where('employee_id', 'like', 'E' . $year . $this->code . '%')
                           ->orderBy('employee_id', 'desc')
                           ->first();

        if ($lastEmployee) {
            $lastSerial = (int) substr($lastEmployee->employee_id, -3);
            return str_pad($lastSerial + 1, 3, '0', STR_PAD_LEFT);
        }

        return '001';
    }
}
