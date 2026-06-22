<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiImage extends Model
{
    use HasFactory;

    public function getPhotoNameAttribute($value)
    {
        if (empty($value) || !file_exists(public_path($value))) {
            return 'back/assets/images/admin/no_image.jpg';
        }
        return $value;
    }
}
