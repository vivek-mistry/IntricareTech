<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $genders = ['Male', 'Female', 'Other'];

        $contacts = [];

        for ($i = 0; $i < 100; $i++) {
            $contacts[] = [
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->numerify('##########'),
                'gender' => $faker->randomElement($genders),
                'profile_image' => $faker->optional()->imageUrl(200, 200, 'people'),
                'document_file' => $faker->optional()->fileExtension(),
                'contact_custom_fields' => json_encode([
                    'company' => $faker->company(),
                    'city' => $faker->city(),
                    'country' => $faker->country(),
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('contacts')->insert($contacts);
    }
}