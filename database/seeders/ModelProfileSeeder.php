<?php

namespace Database\Seeders;

use App\Models\ModelProfiles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class ModelProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $totalUsers = 25;

        for ($i = 1; $i <= $totalUsers; $i++) {
            // Create user
            $user = User::create([
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'email'      => $faker->unique()->safeEmail,
                'password'   => Hash::make('password'), // default password
                'country'    => $faker->country,
                'postal_code'=> $faker->postcode,
            ]);

            // Calculate avatar file (cycle through 1 to 23)
            $avatarNumber = ($i % 23 === 0) ? 23 : $i % 23;
            $avatarPath = "/avatars/{$avatarNumber}.jpeg";

            // Create model profile
            ModelProfiles::create([
                'user_id'     => $user->id,
                'avatar'      => $avatarPath,
                'age'         => $faker->numberBetween(18, 30),
                'gender'      => $faker->randomElement(['Male', 'Female']),
                'height'      => $faker->randomElement(["5'5", "5'6", "5'7", "5'8", "5'9"]),
                'weight'      => $faker->numberBetween(50, 75),
                'experience'  => $faker->sentence(6),
                'location'    => $faker->city . ', ' . $faker->country,
                'latitude'    => $faker->latitude,
                'longitude'   => $faker->longitude,
                'portfolio_url'=> $faker->url,
            ]);
        }
    }
}
