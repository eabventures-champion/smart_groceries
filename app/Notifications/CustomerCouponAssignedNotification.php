<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CustomerCouponAssignedNotification extends Notification
{
    use Queueable;

    protected $coupon;

    public function __construct($coupon)
    {
        $this->coupon = $coupon;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'coupon_id' => $this->coupon->id,
            'coupon_name' => $this->coupon->coupon_name,
            'coupon_discount' => $this->coupon->coupon_discount,
            'message' => 'Congratulations! You have received a personal discount coupon: "' . $this->coupon->coupon_name . '" for ' . $this->coupon->coupon_discount . '% OFF on your next purchase!',
        ];
    }
}
