<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_id',
        'date',
        'start',
        'end',
        'status',
        'visit_type',
        'capacity',
        'current_bookings'
    ];

    public function lab():BelongsTo
    {
        return $this->belongsTo(Lab::class);
    }

    public function  appointments():HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
