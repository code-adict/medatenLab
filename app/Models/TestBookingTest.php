<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestBookingTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_booking_id',
        'test_id'
    ];
}
