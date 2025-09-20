<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketType extends Model
{
    /** @use HasFactory<\Database\Factories\TicketTypeFactory> */
    use HasFactory , softDeletes;
    protected $guarded = ['id'];

    public function scopeFindOrFailWithError($query , $id)
    {
        try {
           return $query->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(response()->json(['message' => 'Ticket not found'], 404));
        }
    }

    public function isAvaliable()
    {
        return $this->quantity > 0 ;
    }
    public function Event()
    {
        return $this->belongsTo(Event::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
