<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\TicketTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "ticket_type_id" => TicketTypes::factory(),
            "customer_id" => Customer::factory(),
        ];
    }
}
