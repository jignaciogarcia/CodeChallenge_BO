<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'address' => fake()->address(),
            'email' => fake()->email(),
            'cellPhoneNumber' => fake()->phoneNumber(),
            'profilePictureUrl' => fake()->url()
        ];
    }
}
