<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lab extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'phone',
        'email',
        'description',
        'image'
    ];
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function appointments():BelongsToMany
    {
        return $this->belongsToMany(Appointment::class);
    }

    public function tests():BelongsToMany
    {
        return $this->belongsToMany(Test::class);
    }
    public function slots():BelongsToMany
    {
        return $this->belongsToMany(Slot::class);
    }
    public function reports():BelongsToMany
    {
        return $this->belongsToMany(Report::class);
    }
}
