<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if user already exists
        $user = User::updateOrCreate(
            ['email' => 'superadmin@credify.com'],
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'password' => Hash::make('password123'),
                'role' => 'super_admin',
                'email_verified_at' => now(),
                'institution_id' => null, // Super admin doesn't belong to any institution
            ]
        );

        $this->command->info('Super Admin user created/updated successfully!');
        $this->command->info('Email: superadmin@credify.com');
        $this->command->info('Password: password123');
    }
}
