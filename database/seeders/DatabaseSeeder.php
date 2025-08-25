<?php

namespace Database\Seeders;

use App\Enum\EventState;
use App\Models\Customer;
use App\Models\Event;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Make a Role
        Role::create(['name' => 'admin' , 'guard_name' => 'web']);

        // Create Admin
        $admin = User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
        ]);

        $admin->assignRole('admin');

        // ADd Events
        Event::factory(10)->create([
            'date' => now()->addDay(4),
            'total_tickets' => 50,
        ]);

        // Add Customer
        Customer::factory()->create([
            'phone' => "0916050468"
        ]);
    }
}
