<?php

namespace Database\Factories;

use App\Models\Proyecto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyecto>
 */
class ProyectoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $proyectos = config('proyectos');
        $name = array_rand($proyectos, 1);
        return [
            'name' => $name,
            'hours' => $this->faker->randomFloat(2, 1, 10),
            'description' => $proyectos[$name],
            'starting_date' => $this->faker->date()
        ];
    }
}
