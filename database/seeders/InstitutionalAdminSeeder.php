<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Institution;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InstitutionalAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing institutions
        $institutions = Institution::all();

        if ($institutions->isEmpty()) {
            $this->command->info('No institutions found. Please run InstitutionSeeder first.');
            return;
        }

        // Create institutional admin users for each institution
        foreach ($institutions as $institution) {
            User::create([
                'first_name' => 'Admin',
                'last_name' => $institution->name,
                'email' => 'admin@' . strtolower(str_replace(' ', '', $institution->name)) . '.edu',
                'password' => Hash::make('password123'),
                'role' => 'institutional_admin',
                'institution_id' => $institution->id,
                'must_change_password' => true,
            ]);
        }

        // Create a few additional test institutional admins
        $testAdmins = [
            [
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'john.smith@university.edu',
                'institution_id' => $institutions->first()->id,
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@college.edu',
                'institution_id' => $institutions->count() > 1 ? $institutions->skip(1)->first()->id : $institutions->first()->id,
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Brown',
                'email' => 'michael.brown@academy.edu',
                'institution_id' => $institutions->last()->id,
            ],
        ];

        foreach ($testAdmins as $admin) {
            User::create([
                'first_name' => $admin['first_name'],
                'last_name' => $admin['last_name'],
                'email' => $admin['email'],
                'password' => Hash::make('password123'),
                'role' => 'institutional_admin',
                'institution_id' => $admin['institution_id'],
                'must_change_password' => false, // Some have already changed passwords
            ]);
        }

        $this->command->info('Institutional admin users created successfully!');
    }
}
