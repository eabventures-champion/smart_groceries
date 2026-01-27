<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCity extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function region(){
        return $this->belongsTo(DeliveryRegion::class, 'region_id', 'id');
    }

     public function district(){
        return $this->belongsTo(DeliveryDistrict::class, 'district_id', 'id');
    }
}
