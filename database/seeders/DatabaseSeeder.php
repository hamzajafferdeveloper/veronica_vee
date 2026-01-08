<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ModelProfileSeeder::class);
        // // Create roles
        // $adminRole = Role::firstOrCreate(['name' => 'admin']);
        // $recruiterRole = Role::firstOrCreate(['name' => 'recruiter']);
        // $professionalRole = Role::firstOrCreate(['name' => 'professional']);

        // // Create a default admin user
        // $admin = User::factory()->create([
        //     'first_name' => 'Admin',
        //     'last_name' => 'User',
        //     'email' => 'admin@example.com',
        // ]);
        // $admin->assignRole($adminRole);

        // $categories = [
        //     'Web Development',
        //     'Graphic Design',
        //     'Digital Marketing',
        //     'Photography',
        //     'Videography',
        //     'Content Writing',
        //     'Mobile App Development',
        //     'UI/UX Design',
        //     'SEO Optimization',
        //     'Social Media Management',
        // ];

        // foreach ($categories as $category) {
        //     DB::table('project_categories')->insert([
        //         'name' => $category,
        //         'slug' => Str::slug($category),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
    }
}
