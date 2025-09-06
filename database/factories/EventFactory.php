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
            'name' => $this->faker->name(),
            'description' => $this->faker->realText(60),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'location' => $this->faker->city(),
            'company_id' => Company::factory(),
        ];
    }
}
