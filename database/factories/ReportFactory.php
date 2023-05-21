<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $hours = rand(1, 8);
        $startDate = $this->faker->dateTimeThisMonth();
        $endDate = (clone $startDate)->modify("+$hours hour");
        return [
            'worker_id' => rand(1, 10),
            'start_work' => $startDate,
            'end_work' => $endDate,
        ];
    }
}
