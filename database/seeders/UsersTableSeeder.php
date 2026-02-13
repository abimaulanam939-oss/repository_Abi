<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    
        // \App\Models\User::create([
        //     'name' => 'Abi',
        //     'email' => 'abiimut@gmail.com',
        //     'password' => bcrypt('123')
            
        // ]);

{
            \App\Models\User::factory()->create([
            'name' => 'Abi',
            'email' => 'abiimut@gmail.com',
            'password' => bcrypt('123'),
        ]);

        
    }
}
    

