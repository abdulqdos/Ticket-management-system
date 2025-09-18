<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\EventResource;
use App\Models\Event;

class EventController extends Controller
{
    public static function index()
    {
        return EventResource::collection(Event::all()) ;
    }

    public static function show(Event $event)
    {
        return EventResource::make($event) ;
    }
}
