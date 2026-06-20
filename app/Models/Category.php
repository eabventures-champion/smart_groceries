<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded= [];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id')->orderBy('subcategory_name', 'ASC');
    }

    public function getCategoryPhotoAttribute($value)
    {
        if (empty($value) || !file_exists(public_path($value))) {
            return 'back/assets/images/products/sliders/no_image.jpg';
        }
        return $value;
    }
}
