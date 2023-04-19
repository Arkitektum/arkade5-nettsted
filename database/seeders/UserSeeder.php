<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Siegfried Roy',
            'email' => 'siegfried@roy.test',
            'password' => '$2y$10$iHG5PAcbkD7ml8X7g9C0FeprfGl/1mxJC/Zo.b6NUEsprfxG57mpW' // arkadeweb
        ]);

        User::factory(5)->create();
    }
}
