<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(LaratrustSeeder::class);

         $SuperAdmin  = \App\Models\User::factory()->create([
             'name' => 'Super Admin',
             'email' => 'SuperAdmin@gmail.com',
             'password' => bcrypt('123123'),
         ]);
         $SuperAdmin->addRole('SuperAdmin');


    }
}
