<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    { 
        //\App\Models\User::factory(10)->create();
        \App\Models\Partner::factory(10)->create();

        /*DB::table('users')->insert([
            'name' => 'Test User',
             'email' => 'test@example.com',
        ]);
        \App\Models\Partner::factory()->create([
            'first_name' => 'Tomas',
             'last_name' => 'Ruiz',
        ]);*/
        
    }
}
