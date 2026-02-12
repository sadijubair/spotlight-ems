<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_types', function (Blueprint $table) {
            $table->id();
            $table->string('code', 2)->unique(); // 01, 02, 03, etc.
            $table->string('name'); // Teacher, Staff, etc.
            $table->string('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default employee types
        DB::table('employee_types')->insert([
            ['code' => '99', 'name' => 'Super Admin', 'description' => 'System Super Administrator', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => '98', 'name' => 'Admin', 'description' => 'Administrator', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => '01', 'name' => 'Teacher', 'description' => 'Teaching Staff', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => '02', 'name' => 'Staff', 'description' => 'General Staff', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => '03', 'name' => 'Accountant', 'description' => 'Accounting Staff', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => '04', 'name' => 'Librarian', 'description' => 'Library Staff', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => '05', 'name' => 'Manager', 'description' => 'Management Staff', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_types');
    }
};
