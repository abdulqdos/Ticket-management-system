<?php

namespace App\Enum ;

enum EventState: string
{
    case PENDING = "PENDING";
    case ACTIVE = "ACTIVE";
    case INACTIVE = "INACTIVE";

    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::ACTIVE => 'success',
            self::INACTIVE => 'danger',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => __('PENDING'),
            self::ACTIVE => __('ACTIVE'),
            self::INACTIVE => __('INACTIVE'),
        };
    }
}
