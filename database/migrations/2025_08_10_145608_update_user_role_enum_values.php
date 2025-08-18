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
        Schema::table('users', function (Blueprint $table) {
            // First, add the new role value to the enum (keeping both old and new)
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('super_admin', 'institution_admin', 'institutional_admin', 'student') NOT NULL");
            
            // Update existing records to use the new role name
            DB::statement("UPDATE users SET role = 'institutional_admin' WHERE role = 'institution_admin'");
            
            // Finally, remove the old role value from the enum
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('super_admin', 'institutional_admin', 'student') NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert the changes
            DB::statement("UPDATE users SET role = 'institution_admin' WHERE role = 'institutional_admin'");
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('super_admin', 'institution_admin', 'student') NOT NULL");
        });
    }
};
