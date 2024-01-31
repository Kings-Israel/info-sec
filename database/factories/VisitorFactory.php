<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'category' => $this->faker->text(5),
            'Company' => $this->faker->company,
            'Role' => $this->faker->text(5),
            'Country' => $this->faker->country
        ];
    }
}
