<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketType>
 */
class TicketTypeFactory extends Factory
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
                "VIP",
                "Economic",
                "1-Degree",
                "2-Degree"
            ]),
            'price' => $this->faker->randomFloat(2,0,1000),
            'quantity' => $this->faker->numberBetween(20,100),
            'event_id' => Event::factory(),
        ];
    }
}
