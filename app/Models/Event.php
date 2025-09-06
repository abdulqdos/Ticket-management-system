<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory , SoftDeletes ;

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
