<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory , SoftDeletes ,  interactsWithMedia ;

    protected $guarded = [];

    public function ticketTypes()
    {
        return $this->hasMany(TicketTypes::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
