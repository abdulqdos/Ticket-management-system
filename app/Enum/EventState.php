<?php

namespace App\Enum ;

enum EventState: string
{
    case PENDING = "PENDING";
    case ACTIVE = "ACTIVE";
    case INACTIVE = "INACTIVE";
    case CANCELLED = "CANCELLED";
}
