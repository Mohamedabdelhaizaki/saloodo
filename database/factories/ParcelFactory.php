<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParcelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => 1,
            'biker_id' => 2,
            'address_from' => $this->faker->address(),
            'address_to' => $this->faker->address(),
            'status' => 0,
        ];
    }
}
