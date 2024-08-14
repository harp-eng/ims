<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage; // Import this class

class SendInvoiceNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;
    protected $invoice;

    public function __construct($order)
    {
        $this->order = $order;
        $this->invoice = $order->invoice;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject('Invoice for Order #' . $this->order->id)
            ->view('emails.invoice_email', [
                'order' => $this->order,
                'invoice' => $this->invoice,
                'paymentLink' => route('stripe.getpost',$this->invoice->id), // Replace with actual payment link
            ]);
    }
}
