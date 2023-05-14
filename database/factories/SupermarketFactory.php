<?php

namespace Database\Factories;

use App\Models\Supermarket;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupermarketFactory extends Factory
{
    protected $model = Supermarket::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'location' => $this->faker->address,
        ];
    }
}

