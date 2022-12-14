<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->name,
            'description'   => $this->faker->paragraph,
            'image_path'    => $this->faker->imageUrl(480, 300),
        ];
    }
}
