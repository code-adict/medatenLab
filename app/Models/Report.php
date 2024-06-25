<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable =[
        'lab_id',
        'patient_id',
        'name',
        'report_code',
        'description',
    ];

    public function patient():BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    public function lab():BelongsTo
    {
        return $this->belongsTo(Lab::class);
    }
}
