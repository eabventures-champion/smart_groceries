<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LowStockAlertNotification extends Notification
{
    use Queueable;

    protected $product;
    protected $stock;

    public function __construct($product, $stock)
    {
        $this->product = $product;
        $this->stock = $stock;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'product_id' => $this->product->id,
            'product_name' => $this->product->product_name,
            'stock' => $this->stock,
            'message' => 'Low stock alert! Product "' . $this->product->product_name . '" has reached a stock level of ' . $this->stock . '.',
        ];
    }
}
