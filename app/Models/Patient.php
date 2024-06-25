<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'dob',
        'gender',
        'image'
    ];

    //Patient's Relationship
    public function bookings(): HasMany
    {
        return $this->hasMany(TestBooking::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(TestReport::class);
    }

}
