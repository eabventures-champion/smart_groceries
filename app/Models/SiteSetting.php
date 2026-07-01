<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Calculate delivery fee based on order amount and student status.
     *
     * @param float $orderAmount
     * @param bool $isStudent
     * @return float
     */
    public static function calculateDeliveryFee($orderAmount, $isStudent)
    {
        $setting = self::find(1);
        if (!$setting) {
            return 0.00;
        }

        if ($orderAmount >= 50 && $orderAmount < 150) {
            return $isStudent 
                ? (float)($setting->student_flat_fee ?? 15.00) 
                : (float)($setting->non_student_flat_fee ?? 20.00);
        } elseif ($orderAmount >= 150) {
            $percent = $isStudent 
                ? (float)($setting->student_percent_fee ?? 10.00) 
                : (float)($setting->non_student_percent_fee ?? 12.50);
            return ($orderAmount * $percent) / 100;
        }

        return 0.00;
    }
}
