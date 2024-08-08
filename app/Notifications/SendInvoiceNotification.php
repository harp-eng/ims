<?php
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SendInvoiceNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;
    protected $invoice;

    public function __construct(Order $order, Invoice $invoice)
    {
        $this->order = $order;
        $this->invoice = $invoice;
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
                'paymentLink' => 'https://example.com/pay/' . $this->invoice->id, // Replace with actual payment link
            ]);
    }
}
