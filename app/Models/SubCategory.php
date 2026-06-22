<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded= [];

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('all_categories_flat');
            \Illuminate\Support\Facades\Cache::forget('categories_nav_5');
            \Illuminate\Support\Facades\Cache::forget('all_categories_with_sub');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('all_categories_flat');
            \Illuminate\Support\Facades\Cache::forget('categories_nav_5');
            \Illuminate\Support\Facades\Cache::forget('all_categories_with_sub');
        });
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
