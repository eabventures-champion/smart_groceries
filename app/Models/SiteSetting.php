<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the minimum order amount threshold for delivery.
     *
     * @return float
     */
    public static function getMinOrderAmount()
    {
        $setting = self::find(1);
        return $setting && $setting->min_order_amount !== null 
            ? (float)$setting->min_order_amount 
            : 50.00;
    }

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

        $minOrder = self::getMinOrderAmount();

        if ($orderAmount >= $minOrder && $orderAmount < 150) {
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

    /**
     * Get active delivery days as an array of Carbon day numbers (1 = Mon, ..., 7 = Sun).
     * Default: [1, 4, 6] (Monday, Thursday, Saturday).
     *
     * @return array
     */
    public static function getDeliveryDays()
    {
        $setting = self::find(1);
        if ($setting && !empty($setting->delivery_days)) {
            $days = array_filter(array_map('intval', explode(',', $setting->delivery_days)));
            if (!empty($days)) {
                return array_values($days);
            }
        }
        return [1, 4, 6];
    }

    /**
     * Get delivery cutoff time as array [hour, minute]. Default: [11, 0].
     *
     * @return array
     */
    public static function getDeliveryCutoffTime()
    {
        $setting = self::find(1);
        if ($setting && !empty($setting->delivery_cutoff_time)) {
            $parts = explode(':', $setting->delivery_cutoff_time);
            $hour = isset($parts[0]) ? (int)$parts[0] : 11;
            $minute = isset($parts[1]) ? (int)$parts[1] : 0;
            return [$hour, $minute];
        }
        return [11, 0];
    }

    /**
     * Get formatted delivery days text string (e.g., "Mondays, Thursdays, and Saturdays").
     *
     * @return string
     */
    public static function getDeliveryDaysFormatted()
    {
        $days = self::getDeliveryDays();
        $map = [
            1 => 'Mondays',
            2 => 'Tuesdays',
            3 => 'Wednesdays',
            4 => 'Thursdays',
            5 => 'Fridays',
            6 => 'Saturdays',
            7 => 'Sundays',
        ];
        $names = array_map(fn($d) => $map[$d] ?? '', $days);
        $names = array_filter($names);
        
        if (count($names) === 1) {
            return reset($names);
        }
        if (count($names) === 2) {
            return implode(' and ', $names);
        }
        $last = array_pop($names);
        return implode(', ', $names) . ', and ' . $last;
    }

    /**
     * Get formatted cutoff time string (e.g. "11:00 AM").
     *
     * @return string
     */
    public static function getCutoffTimeFormatted()
    {
        list($hour, $minute) = self::getDeliveryCutoffTime();
        return \Carbon\Carbon::createFromTime($hour, $minute)->format('g:i A');
    }
}
