<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'test_id',
        'booking_id',
        'result',
        'report_date'
    ];

    public function patient():BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    public function booking():BelongsTo
    {
        return $this->belongsTo(TestBooking::class);
    }

    public function test():BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
