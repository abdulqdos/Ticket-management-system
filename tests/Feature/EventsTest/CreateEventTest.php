<?php

use App\Models\Event;
use App\Models\Company;
use App\actions\EventActions\CreatEventAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    $this->company = Company::factory()->create([
        "phone" => "0916050468",
        "name" => "Sahab"
    ]);

    $this->ticketTypes = [
        (object)[
            'name' => 'VIP',
            'price' => 100,
            'quantity' => 10,
        ],
        (object)[
            'name' => 'Regular',
            'price' => 50,
            'quantity' => 20,
        ],
    ];

});

it('creates an event with ticket types', closure: function () {
    $action = new CreatEventAction(
        name: 'Test Event',
        description: 'This is a test event',
        start_date: now()->addDays(1),
        end_date: now()->addDays(2),
        location: 'Tripoli',
        company: $this->company->id,
        ticketTypes: $this->ticketTypes
    );

    $event = $action->execute();


    expect(Event::count())->toBe(1);
    expect($event->name)->toBe('Test Event');
    expect($event->location)->toBe('Tripoli');

    expect($event->ticketTypes)->toHaveCount(2);
    expect($event->ticketTypes()->first()->name)->toBe('VIP');
});
