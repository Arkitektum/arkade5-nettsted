<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Siegfried Roy',
            'email' => 'siegfried@roy.test',
            'password' => '$2y$10$iHG5PAcbkD7ml8X7g9C0FeprfGl/1mxJC/Zo.b6NUEsprfxG57mpW' // arkadeweb
        ]);

        factory(App\User::class, 5)->create();
    }
}
