<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function region(){
        return $this->belongsTo(DeliveryRegion::class, 'region_id','id');
    }

     public function district(){
        return $this->belongsTo(DeliveryDistrict::class, 'district_id','id');
    }

     public function city(){
        return $this->belongsTo(DeliveryCity::class, 'city_id','id');
    }
     public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
