<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributesRecord=[
            [
                'id' => 1,
                'product_id' => 1,
                'size' => 'small',
                'price' => 1500,
                'stock' => 50,
                'sku' => 'SL-2-s',
                'status' => 1,
            ],
            [
                'id' => 2,
                'product_id' => 2,
                'size' => 'medium',
                'price' => 45500,
                'stock' => 30,
                'sku' => 'SQ-2-m',
                'status' => 1,
            ],
            [
                'id' => 3,
                'product_id' => 3,
                'size' => 'large',
                'price' => 100,
                'stock' => 20,
                'sku' => 'ST 567-l',
                'status' => 1,
            ],
        ];
        ProductAttribute::insert($productAttributesRecord);
    }
}
