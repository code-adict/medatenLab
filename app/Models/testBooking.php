<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class testBooking extends Model
{
    protected $fillable = [
        'booking_id',
        'patient_id',
        'nearbyLabs_id',
        'test_date',
        'test_time',
        'visit_type',
        'status',
    ];

    public function homeVisits(): HasMany
    {
        return $this->hasMany(HomeVisit::class, 'booking_id');
    }
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patients_id');
    }

    public function nearbyLabs(): BelongsTo
    {
        return $this->belongsTo(NearbyLab::class, 'nearbyLabs_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->booking_id)) {
                $model->booking_id = self::generateUniqueBookingId();
            }
        });
    }

    public static function generateUniqueBookingId(): string
    {
        do {
            $bookingId = 'MDT' . Str::upper(Str::random(7));
        } while (self::where('booking_id', $bookingId)->exists());

        return $bookingId;
    }
}
