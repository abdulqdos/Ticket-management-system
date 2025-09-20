<?php

namespace App\actions\TicketActions ;

use App\Models\Ticket;
use App\Models\TicketType;
use Illuminate\Support\Facades\DB;

class DeleteTicketAction
{
    public function __construct(
        public int $ticket_type_id,
        public int $customer_id,
        public TicketType $ticket_type,
    ) {}

    public function execute()
    {
        return DB::transaction(function ()  {
            $this->ticket_type->increment('quantity');
            Ticket::where('customer_id' , $this->customer_id)->where('ticket_type_id' , $this->ticket_type_id)->delete();
        });
    }
}
