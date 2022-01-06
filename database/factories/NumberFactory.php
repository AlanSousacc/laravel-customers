<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NumberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrayStatus = ['active', 'inactive', 'cancelled'];
        return [
            'number' => $this->faker->numberBetween(100000, 999999999),
            'status' => $arrayStatus[rand(0,2)],
        ];
    }
}
