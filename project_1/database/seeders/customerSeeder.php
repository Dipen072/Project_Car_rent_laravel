<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class customerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 100; $i++) {

            $table = new Customer();

            $table->name = $faker->name;
            $table->email = $faker->unique()->safeEmail;
            $table->mobile = $faker->numerify('9#########'); // Indian mobile
            $table->address = $faker->address;
            $table->gender = $faker->randomElement(['Male', 'Female', 'Other']);
            $table->hobbies = $faker->randomElement(['Reading', 'Writing', 'Traveling', 'Playing']);
            $table->city = $faker->city;
            $table->state = $faker->state;
            $table->pincode = $faker->postcode; // correct
            $table->license_number = strtoupper($faker->bothify('??######')); // custom
            $table->password = Hash::make('123456'); // hashed password
            $table->save();
        }
    }
}