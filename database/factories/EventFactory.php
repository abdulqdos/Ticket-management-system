<?php

namespace Database\Factories;

use App\Enum\EventState;
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
            'description' => $this->faker->text(),
            'state' => $this->faker->randomElement(EventState::class),
            'date' => $this->faker->date(),
            'total_tickets' => $this->faker->randomNumber([0 , 100]),
        ];
    }
}
