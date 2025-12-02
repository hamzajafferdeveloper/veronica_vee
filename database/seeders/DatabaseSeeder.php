<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $recruiterRole = Role::firstOrCreate(['name' => 'recruiter']);
        $professionalRole = Role::firstOrCreate(['name' => 'professional']);

        // Create a default admin user
        $admin = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole($adminRole);
//
//        // Create a default recruiter user
//        $recruiter = User::factory()->create([
//            'first_name' => 'Recruiter',
//            'last_name' => 'User',
//            'email' => 'recruiter@example.com',
//        ]);
//        $recruiter->assignRole($recruiterRole);
//
//        // Create a default professional user
//        $professional = User::factory()->create([
//            'first_name' => 'Professional',
//            'last_name' => 'User',
//            'email' => 'professional@example.com',
//        ]);
//        $professional->assignRole($professionalRole);
//
//        // Create additional 10 random users
//        User::factory(10)->create();
    }
}
