<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrayStatus = ['new', 'active', 'suspended', 'cancelled'];
        return [
            'name' => $this->faker->name,
            'user_id' => 1,
            'document' => $this->faker->numberBetween(1, 100),
            'status' => $arrayStatus[rand(0,3)],
        ];
    }
}
