<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Pet::factory(25)->create();
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'victor',
            'email' => 'victor@email.com',
            'password' => 'victor',
        ]);
    }
}
