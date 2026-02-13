<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
         $this->call ([
            // UsersTableSeeder::class
            

         ]);   
          User::create([
            'name' => 'Abi',
            'email' => 'abiimut@gmail.com',
            'password' => 'bcrypt'('123'),
          ]);    

         User::create([
            'name' => 'Abi2',
            'email' => 'abiimut2@gmail.com',
            'password' => 'bcrypt'('123'),
          ]);    

           User::create([
            'name' => 'Abi3',
            'email' => 'abiimut3@gmail.com',
            'password' => 'bcrypt'('123'),
          ]);    
    }
}
