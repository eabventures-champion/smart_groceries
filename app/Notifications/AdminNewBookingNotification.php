<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminNewBookingNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'message' => 'New Expert Booking request! ' . $this->booking->user_name . ' booked ' . $this->booking->expert_name . ' on ' . date('d M Y', strtotime($this->booking->booking_date)),
        ];
    }
}
