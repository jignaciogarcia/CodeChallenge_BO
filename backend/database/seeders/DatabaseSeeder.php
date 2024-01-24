<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(1)->create()->each(function($user) 
        {
            Contact::factory(2)->create(['user_id' => $user->id]);
        });

        User::factory(1)->create();
    }
}
