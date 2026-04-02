<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use Faker\Factory as Faker;

class contactseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $Faker = Faker::create();
        for($i=1;$i<=100;$i++)
        {
        $table=new Contact();
        $table->name = $Faker->name;
        $table->email = $Faker->email;
        $table->comment = $Faker->realText;
        $table->save();
        }
                        
    }
}
