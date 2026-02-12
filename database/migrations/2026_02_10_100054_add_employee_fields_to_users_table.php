<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('employee_id')->unique()->nullable()->after('id');
            $table->string('student_id')->unique()->nullable()->after('employee_id');
            $table->string('guardian_id')->unique()->nullable()->after('student_id');
            $table->enum('user_type', ['employee', 'student', 'guardian', 'user'])->default('user')->after('guardian_id');
            $table->foreignId('employee_type_id')->nullable()->constrained('employee_types')->onDelete('set null')->after('user_type');
            $table->boolean('is_super_admin')->default(false)->after('employee_type_id');
            $table->date('date_of_joining')->nullable()->after('is_super_admin');
            $table->enum('status', ['active', 'inactive', 'suspended', 'terminated'])->default('active')->after('date_of_joining');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['employee_type_id']);
            $table->dropColumn(['employee_id', 'student_id', 'guardian_id', 'user_type', 'employee_type_id', 'is_super_admin', 'date_of_joining', 'status']);
        });
    }
};
