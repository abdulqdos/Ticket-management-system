<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\TicketTypeResource;
use App\Models\TicketType;
use Illuminate\Http\Request;

class ticketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TicketTypeResource::collection(TicketType::all());
    }

    public function show(TicketType $ticketType)
    {
        return TicketTypeResource::make($ticketType);
    }

}
