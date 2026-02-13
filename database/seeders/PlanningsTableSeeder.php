<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanningsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\planning::create([
            'customer_id' => '1',
            'planned_date' => '2025-04-11',
            'is_active' =>'123',
        ]);
    }
}
