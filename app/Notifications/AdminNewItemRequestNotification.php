<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminNewItemRequestNotification extends Notification
{
    use Queueable;

    protected $itemRequest;

    public function __construct($itemRequest)
    {
        $this->itemRequest = $itemRequest;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'item_request_id' => $this->itemRequest->id,
            'message' => 'New custom product request! Item: "' . $this->itemRequest->product_name . '" (Qty: ' . $this->itemRequest->quantity . ')',
        ];
    }
}
