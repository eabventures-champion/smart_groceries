<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Estimate delivery day and proximity.
     * Delivery days are Mondays, Thursdays, Saturdays.
     * Cutoff time on delivery days is 11:00 AM.
     */
    public static function getDeliveryEstimation($time = null)
    {
        if (!$time) {
            $time = \Carbon\Carbon::now();
        } else {
            $time = \Carbon\Carbon::parse($time);
        }

        $dayOfWeek = (int)$time->format('N'); // 1 = Monday, ..., 7 = Sunday
        $hour = (int)$time->format('G'); // 0-23
        $minute = (int)$time->format('i');

        $isQueued = false;
        $deliveryDate = null;
        
        // Check if today is a delivery day
        $isDeliveryDay = in_array($dayOfWeek, [1, 4, 6]); // Mon, Thu, Sat
        
        if ($isDeliveryDay) {
            // If it's a delivery day, is it before 11:00 AM?
            if ($hour < 11 || ($hour == 11 && $minute == 0)) {
                // Can be delivered today
                $deliveryDate = $time->copy();
                $isQueued = false;
            } else {
                // Past 11am on a delivery day. Queue for the NEXT delivery day.
                $isQueued = true;
                $deliveryDate = self::findNextDeliveryDay($time);
            }
        } else {
            // Not a delivery day. Scheduled for the next delivery day.
            $deliveryDate = self::findNextDeliveryDay($time);
            $isQueued = false;
        }

        // Proximity calculation: number of days from $time's date to $deliveryDate's date
        // diffInDays will return 0 if they are on the same day.
        $proximity = (int) $time->startOfDay()->diffInDays($deliveryDate->startOfDay(), false);

        return [
            'is_delivery_day' => $isDeliveryDay,
            'is_past_cutoff' => $isDeliveryDay && ($hour > 11 || ($hour == 11 && $minute > 0)),
            'next_delivery_date' => $deliveryDate->format('Y-m-d'),
            'next_delivery_date_formatted' => $deliveryDate->format('l, d F Y'),
            'proximity_days' => $proximity,
            'is_queued' => $isQueued
        ];
    }

    private static function findNextDeliveryDay($time)
    {
        // Start checking from the next day
        $temp = $time->copy()->addDay();
        while (true) {
            $dayOfWeek = (int)$temp->format('N');
            if (in_array($dayOfWeek, [1, 4, 6])) { // Monday, Thursday, Saturday
                return $temp;
            }
            $temp->addDay();
        }
    }

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
