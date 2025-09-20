<?php

namespace App\actions\BookingActions ;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

Class CreateBookingActions
{
    public function __construct(
        public int $customer_id,
        public int $event_id,
    ) {}

    public function execute(): Customer
    {
        return DB::transaction(function () {
            return Ticket::create([
                'customer' => $this->customer_id,
                'event_id' => $this->event_id,
            ]);
        });
    }
}
