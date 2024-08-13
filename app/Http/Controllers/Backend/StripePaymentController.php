<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Stripe;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Invoice;
use Modules\Transaction\Models\Transaction;
use Stripe\Exception\InvalidRequestException;
use Modules\Order\Models\Order;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request, $invoice_id): View
    {
        $invoice = Invoice::find($invoice_id);
        if (empty($invoice)) {
            session()->flash('error', 'Invoice not found');
        }
        if ($invoice->status == 'paid') {
            session()->flash('success', 'Payment successful!');
        }

        return view('backend.stripe', compact('invoice'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request): RedirectResponse
    {
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $invoice = Invoice::find($request->invoice_id);
            $paymentIntent = Stripe\Charge::create([
                'amount' => 10 * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for invoice #' . $invoice->invoice_number,
            ]);

            if ($paymentIntent['status'] == 'succeeded') {
                $invoice = Invoice::find($request->invoice_id);
                $invoice->status = 'paid';
                $invoice->save();

                $order = Order::find($invoice->order_id);
                $order->payment_status = 'Paid';
                $order->save();

                // Extract relevant information from Stripe response
                $transactionData = [
                    'description' => $paymentIntent->description,
                    'transaction_status' => $paymentIntent->status,
                    'user_id' => $invoice->user_id, // Adjust based on how you store user ID
                    'order_id' => $invoice->order_id, // Adjust based on how you store user ID
                    'payment_method' => $paymentIntent->payment_method_types[0] ?? '',
                    'transaction_date' => \Carbon\Carbon::createFromTimestamp($paymentIntent->created),
                    'amount' => $paymentIntent->amount_received / 100, // Stripe amount is in cents
                    'currency' => $paymentIntent->currency,
                    'transaction_data' => json_encode($paymentIntent),
                    'reference_number' => $paymentIntent->id,
                ];

                // Store information in the database
                Transaction::create($transactionData);

                session()->flash('success', 'Payment successful!');
            } else {
                $transactionData = [
                    'description' => $paymentIntent->description,
                    'transaction_status' => $paymentIntent->status,
                    'user_id' => $invoice->user_id, // Adjust based on how you store user ID
                    'payment_method' => $paymentIntent->payment_method_types[0] ?? '',
                    'transaction_date' => \Carbon\Carbon::createFromTimestamp($paymentIntent->created),
                    'amount' => $paymentIntent->amount_received / 100, // Stripe amount is in cents
                    'currency' => $paymentIntent->currency,
                    'transaction_data' => json_encode($paymentIntent),
                    'reference_number' => $paymentIntent->id,
                ];

                // Store information in the database
                Transaction::create($transactionData);
                session()->flash('error', 'Something went wrong');
            }
        } catch (InvalidRequestException $e) {
            session()->flash('error', 'The Stripe token has already been used. Please refresh the page and try again with a new token.');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while processing the payment. Please try again later.');
        }
        return redirect()->back();
    }
}
