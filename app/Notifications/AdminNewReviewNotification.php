<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminNewReviewNotification extends Notification
{
    use Queueable;

    protected $review;

    public function __construct($review)
    {
        $this->review = $review;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'review_id' => $this->review->id,
            'message' => 'New Product Review submitted! Product ID: ' . $this->review->product_id . ' (Rating: ' . $this->review->rating . '/5)',
        ];
    }
}
