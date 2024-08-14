<!-- resources/views/emails/invoice_email.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Invoice for Order #{{ $order->id }}</title>
</head>
<body>
    <h2>Invoice for Order #{{ $order->id }}</h2>
    <p>Invoice Number: {{ $invoice->invoice_number }}</p>
    <p>Amount: ${{ number_format($invoice->total, 2) }}</p>
    <p>Payment Link: <a href="{{ $paymentLink }}">Click here to pay</a></p>
    <!-- Other invoice details as needed -->
</body>
</html>
