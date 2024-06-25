<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'shortcut',
        'sample_type',
        'description',
        'category_id',
        'lab_id',
        'price',
        'image'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function lab(): BelongsTo
    {
        return $this->belongsTo(Lab::class);
    }

    public function appointment(): BelongsToMany
    {
        return $this->belongsToMany(appointment::class);
    }

//    public function team(): BelongsTo
//    {
//        return $this->belongsTo(Team::class);
//    }
}
