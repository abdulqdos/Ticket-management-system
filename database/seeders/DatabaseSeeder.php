<?php

namespace Database\Seeders;

use App\Enum\EventState;
use App\Models\Event;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Event::factory()->create([
            'state' => EventState::PENDING,
            'date' => now()->addDay(4),
            'total_tickets' => 50,
        ]);
    }
}
