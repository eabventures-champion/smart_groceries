<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // public function attributes(){
    //     return $this->hasMany(ProductAttribute::class);
    // }

    // <td class="price" data-title="Stock">
    //     ${value.product.product_qty > 0 
    //         ? `<span class="stock-status in-stock mb-0"> In Stock </span>`
    //         :`<span class="stock-status out-stock mb-0">Stock Out </span>`
    //     }                            
    // </td>
}
