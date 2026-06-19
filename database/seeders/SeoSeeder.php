<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seo;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seo::updateOrCreate(
            ['id' => 1],
            [
                'meta_title' => 'Smart Groceries - Student Grocery Delivery',
                'meta_author' => 'Smart Groceries Team',
                'meta_keyword' => 'student groceries, cheap groceries, university food delivery, smart groceries, campus grocery delivery, hostel delivery',
                'meta_description' => 'Smart Groceries is the ultimate student grocery platform. Get fresh products, snacks, toiletries, and essentials delivered directly to your hostel or campus residence at student-friendly prices.'
            ]
        );
    }
}
