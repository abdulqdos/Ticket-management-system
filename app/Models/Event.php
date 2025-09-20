<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory , SoftDeletes ,  interactsWithMedia ;

    protected $guarded = [];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function scopeFindOrFailWithError($query , $id)
    {
        try {
           return $query->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(response()->json(['message' => 'Event not found'], 404));
        }
    }

    public function getTicketType(TicketType $ticketType): bool
    {
        return $ticketType->event_id === $this->id;
    }

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
