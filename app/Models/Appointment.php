<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'slot_id',
        "test_id",
        'patient_id',
        'description',
    ];

///Define the relationship of this table and other tables
    public function slot(): BelongsTo
    {
        return $this->belongsTo(Slot::class);
    }

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function lab(): BelongsToMany
    {
        return $this->belongsToMany(Lab::class);
    }

}
