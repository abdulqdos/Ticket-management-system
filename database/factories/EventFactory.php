<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                "Sahab Tech Solutions",
                "Libyan Web Co.",
                "IT Guys Network",
                "Tripoli Innovations",
                "Cyber Libya"
            ]),
            'description' => $this->faker->paragraph(2),
            'start_date' => $this->faker->dateTimeBetween('tomorrow', '+1 month'),
            'end_date' => $this->faker->dateTimeBetween('start_date', '+2 weeks'),
            'location' => $this->faker->city() . ', Libya',
            'company_id' => Company::factory(),
        ];
    }
}
