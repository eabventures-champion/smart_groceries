<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecognitionTier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'min_spent',
        'discount_percent',
        'badge_style',
    ];
}
