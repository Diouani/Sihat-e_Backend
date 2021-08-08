<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('users')->insert([
                'email' => $faker->unique()->safeEmail,
                            'password' => bcrypt('password@123'), // Can also be used Hash::make('password@123')
                            'email_verified_at' => now(),
                            'remember_token' => Str::random(10)
                   ]);
        }
    }

}
