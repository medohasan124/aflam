<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\genra;
use App\Models\movie;
use App\Models\setting;
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

        setting::create([
            'email'=>'SuperAdmin@gmail.com',
            'keyword'=>'hi hello and no',
            'desc'=>'Small Description',
            'image'=>'default.png',
         ]);

        //  genra::create(['name'=>'testing Genra']) ;

         movie::create([
            'eid' =>           '1',
            'adult' =>         true,
            'backdrop' =>      'test.png',
            'language' =>      'ar',
            'title' =>        'test title',
            'description' =>   'this is a spaal description',
            'poster' =>        'poster.png',
            'release_date' =>  '2024-06-11',
            'vote' =>          7.8,
            'vote_count' =>    300,
        ]);


    }
}
