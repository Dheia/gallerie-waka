<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Charles',
            'email' => 'charles@notilac.fr',
            'password' => $hashed = Hash::make('05010501'),
        ]);
        $this->call(PageSeeder::class); 
        $this->call(TableauTagSeeder::class); 
        $this->call(TableauSeeder::class); 
        
        

    }
}
