<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'badge_style',
        'icon',
    ];

    public function experts()
    {
        return $this->hasMany(Expert::class);
    }
}
