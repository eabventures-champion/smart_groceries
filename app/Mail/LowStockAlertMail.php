<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LowStockAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $product;
    public $stock;

    public function __construct($product, $stock)
    {
        $this->product = $product;
        $this->stock = $stock;
    }

    public function envelope()
    {
        return new Envelope(
            from: new Address('alerts@smartgroceries.org', 'Smart Groceries Alerts'),
            subject: '⚠️ Low Stock Alert: ' . $this->product->product_name,
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail.low_stock_alert',
        );
    }

    public function attachments()
    {
        return [];
    }
}
