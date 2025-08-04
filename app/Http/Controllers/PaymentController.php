<?php

namespace App\Http\Controllers;

use App\Helpers\OnepayHelper;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderStatusUpdatedMail;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{


    public function showPaymentPage($order_code)
    {
        $order = CustomerOrder::where('order_code', $order_code)
                              ->with(['items.product', 'items.dealerProductLink.dealer.dealerProfile'])
                              ->firstOrFail();

        // Get the maximum delivery fee from the related products in the order items
        $deliveryFee = $order->items->max(function ($item) {
            return optional($item->product)->fee->fee ?? 300;
        });


        // Get dealer from the first order item's dealer product link
        $dealer = $order->items->first()?->dealerProductLink?->dealer;



        return view('frontend.payment', compact('order', 'dealer','deliveryFee'));
    }



    public function confirmCODOrder($order_code)
    {
        try {
            $order = CustomerOrder::where('order_code', $order_code)->where('user_id', Auth::id())->firstOrFail();

            // Update the payment method and payment status
            $order->update([
                'payment_method' => 'COD',
                'payment_status' => 'Not Paid',
            ]);

            // Send order confirmation email to customer
            if ($order->email) {
                Mail::to($order->email)->send(new OrderConfirmationMail($order));
            }


            return redirect()->route('order.thankyou', ['order_code' => $order_code])
                            ->with('success', 'Order confirmed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to confirm order. Please try again.');
        }
    }

    public function confirmcardOrder($order_code)
    {
        try {
            $order = CustomerOrder::where('order_code', $order_code)->where('user_id', Auth::id())->firstOrFail();

            // Update the payment method and payment status
            $order->update([
                'payment_method' => 'Card',
                'payment_status' => 'Pending',
            ]);

            // Payment details
            $amount   = $order->total_cost; // Amount in LKR
            $currency = 'LKR';
            $hash     = OnepayHelper::generateHash($currency, $amount);
            $reference = 'FAIRWAVES_' . time();

            Log::info('Initiating OnePay Payment', [
                'currency'                 => $currency,
                'app_id'                   => config('onepay.app_id'),
                'hash'                     => $hash,
                'amount'                   => number_format($amount, 2, '.', ''),
                'reference'                => $reference,
                'customer_first_name' => optional($order->user)->fname ?? 'Unknown',
                'customer_last_name'  => optional($order->user)->lname ?? 'Unknown',
                'customer_phone_number'    => $order->phone,
                'customer_email'           => $order->email,
                'transaction_redirect_url' => route('order.thankyou', ['order_code' => $order_code]),
                'additional_data'          => $reference,
            ]);

            // Make API request to OnePay
            $response = Http::withHeaders([
                'Authorization' => config('onepay.api_key'),
            ])->post(config('onepay.base_url') . '/checkout/link/', [
                'currency'                 => $currency,
                'app_id'                   => config('onepay.app_id'),
                'hash'                     => $hash,
                'amount'                   => $amount,
                'reference'                => $reference,
                'customer_first_name' => optional($order->user)->fname ?? 'Unknown',
                'customer_last_name'  => optional($order->user)->lname ?? 'Unknown',
                'customer_phone_number'    => $order->phone,
                'customer_email'           => $order->email,
                'transaction_redirect_url' => route('order.thankyou', ['order_code' => $order_code]),
                'additional_data'          => $reference,
            ]);

            Log::info('OnePay Payment Response', [
                'status' => $response->status(),
                'body'   => $response->json(),
            ]);

            if ($response->successful() && isset($response['data']['gateway']['redirect_url'])) {
                $redirectUrl = $response['data']['gateway']['redirect_url'];

                Log::info('Redirecting to OnePay', ['url' => $redirectUrl]);

                // Save transaction ID
                $order->update([
                    'payment_method'  => 'Card',
                    'payment_status'  => 'Pending',
                    'transaction_id'  => $reference,
                ]);

                return redirect()->away($redirectUrl);
            }

            // Log unsuccessful response
            Log::error('OnePay payment failed or missing redirect URL', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);



            // return redirect()->route('order.thankyou', ['order_code' => $order_code])
            //                 ->with('success', 'Order confirmed successfully!');
            return redirect()->back()->with('error', 'Payment initiation failed. Please try again.');
        } catch (\Exception $e) {
            // Log exception with detail
            Log::error('Error in confirmcardOrder', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ]);

            return redirect()->back()->with('error', 'Failed to confirm order. Please try again.');
        }
    }



    public function getOrderDetails($order_code)
    {
        $order = CustomerOrder::where('order_code', $order_code)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        if ($order->payment_status == "Not Paid") {
            return view('frontend.place_order', [
                'order_code' => $order_code,
                'total_cost' => $order->total_cost,
            ]);
        }

        if ($order->payment_status != "Paid") {
            return redirect()->route('order.payment-fail')->with('error', 'Order not found.');
        }

        // Send email to customer
        if ($order->email) {
            Mail::to($order->email)->send(new OrderStatusUpdatedMail($order, $order->status));
        }


        $orderItems = CustomerOrderItems::where('order_code', $order_code)->get();
        return view('frontend.order_received', compact('order', 'orderItems'));
    }

    public function paymentFail()
    {
        return view('frontend.payment-fail');
    }

    public function getPaymentInfo(Request $request)
    {
        Log::info("this is working");
        Log::info('Original response from onepay : ', ['response' => $request]);

        try {
            $statusMessage = $request->input('status_message');
            $reference = $request->input('additional_data');

            // Find the order by the transaction_id (stored as additional_data / reference)
            $order = CustomerOrder::where('transaction_id', $reference)->first();

            if (!$order) {
                Log::error('Order not found for transaction reference: ' . $reference);
                return redirect()->route('order.payment-fail')->with('error', 'Order not found.');
            }

            if (strtoupper($statusMessage) === 'SUCCESS') {
                $order->update(['payment_status' => 'Paid']);
                Log::info('Order marked as Paid', ['order_code' => $order->order_code]);

                // Send order confirmation email to customer
                if ($order->email) {
                    try {
                        Mail::to($order->email)->send(new OrderConfirmationMail($order));
                        Log::info('Order confirmation email sent', ['order_code' => $order->order_code, 'email' => $order->email]);
                    } catch (\Exception $e) {
                        Log::error('Failed to send order confirmation email: ' . $e->getMessage());
                    }
                }

                // // ✅ Send SMS to vendor
                // try {
                //     $smsService = new DialogSMSService();
                //     $vendorMobile = env('SMS_PHONE_NUMBER'); // Change this to your vendor's actual mobile number
                //     $message = "New Card Order Received:\nOrder Code: {$order->order_code}\nTotal: Rs. {$order->total}";

                //     $smsService->sendSMS($vendorMobile, $message);
                // } catch (\Exception $e) {
                //     Log::error('Failed to send SMS to vendor: ' . $e->getMessage());
                // }

                return response()->json(['message' => 'Payment confirmed and order updated.']);
            } else {
                $order->update(['payment_status' => 'Not Paid']);
                Log::warning('Payment failed or not successful', ['status_message' => $statusMessage]);
                return redirect()->route('order.payment-fail')->with('error', 'Payment was not successful.');
            }
        } catch (\Exception $e) {
            Log::error('Error handling payment callback', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ]);

            return redirect()->route('order.payment-fail')->with('error', 'An error occurred while processing the payment.');
        }
    }


}
