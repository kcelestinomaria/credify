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
        Schema::table('credentials', function (Blueprint $table) {
            // Rename student_id to user_id for consistency
            $table->renameColumn('student_id', 'user_id');
            
            // Add issued_by field to track who issued the credential
            $table->foreignId('issued_by')->after('institution_id')->constrained('users')->onDelete('cascade');
            
            // Add student information fields
            $table->string('student_first_name')->after('issued_by');
            $table->string('student_last_name')->after('student_first_name');
            $table->string('student_school_id')->after('student_last_name');
            
            // Update type enum to match our requirements
            $table->dropColumn('type');
            $table->enum('type', ['Degree', 'Certificate', 'Diploma'])->after('student_school_id');
            
            // Make file_path nullable (optional)
            $table->string('file_path')->nullable()->change();
            
            // Make qr_code_path nullable (we'll generate this later)
            $table->string('qr_code_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('credentials', function (Blueprint $table) {
            // Reverse the changes
            $table->renameColumn('user_id', 'student_id');
            $table->dropForeign(['issued_by']);
            $table->dropColumn(['issued_by', 'student_first_name', 'student_last_name', 'student_school_id']);
            $table->dropColumn('type');
            $table->enum('type', ['degree', 'diploma', 'certificate']);
            $table->string('file_path')->change();
            $table->string('qr_code_path')->change();
        });
    }
};
