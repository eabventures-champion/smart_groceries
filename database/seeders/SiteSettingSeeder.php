<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'logo' => 'upload/logo/logo.png',
                'support_phone' => '0548795583',
                'phone_one' => '0555700931',
                'email' => 'support@smartgroceries.org',
                'company_address' => 'University Campus Hostel delivery service',
                'facebook' => 'https://facebook.com/smartgroceries',
                'twitter' => 'https://twitter.com/smartgroceries',
                'youtube' => 'https://youtube.com/c/smartgroceries',
                'copyright' => '© 2026 Smart Groceries. All rights reserved.',
                'referral_commission_type' => 'flat',
                'referral_flat_amount' => 15.00,
                'referral_percentage' => 10.00,
            ]
        );
    }
}
