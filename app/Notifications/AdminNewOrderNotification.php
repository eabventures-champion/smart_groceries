<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminNewOrderNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'invoice_no' => $this->order->invoice_no,
            'message' => 'New Order received! Invoice #' . $this->order->invoice_no . ' total Gh ' . number_format($this->order->amount, 2),
        ];
    }
}
