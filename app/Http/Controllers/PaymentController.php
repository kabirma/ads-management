<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController
{
    protected $merchantId;
    protected $apiKey;
    protected $apiSecret;
    protected $baseUrl;

    public function __construct()
    {
        $this->merchantId = env('MASTERCARD_MERCHANT_ID');
        $this->apiKey = env('MASTERCARD_API_KEY');
        $this->apiSecret = env('MASTERCARD_API_SECRET');
        $this->baseUrl = env('MASTERCARD_BASE_URL');
    }

    public function createCheckoutSession($amount, $currency)
    {
        $endpoint = "{$this->baseUrl}/api/rest/version/61/merchant/{$this->merchantId}/session";
        
        $payload = [
            "apiOperation" => "INITIATE_CHECKOUT",
            "interaction" => [
                "operation" => "AUTHORIZE",
                "returnUrl" => route('mastercard.success'),
                "cancelUrl" => route('mastercard.cancel'),
            ],
            "order" => [
                "amount" => $amount,
                "currency" => $currency,
                "id" => uniqid("order_"),
            ]
        ];

        $response = Http::withBasicAuth($this->apiKey, $this->apiSecret)
            ->post($endpoint, $payload);

        return $response->json();
    }

    public function showCheckout()
    {
        return view('mastercard.checkout');
    }

    /**
     * Generate Hosted Checkout Session
     */
    public function createCheckout(Request $request)
    {
        $amount = $request->amount; 
        $currency = "USD";

        $sessionData = $this->createCheckoutSession($amount, $currency);

        return view('mastercard.payment', compact('sessionData'));
    }

    /**
     * Handle Payment Success
     */
    public function paymentSuccess(Request $request)
    {
        return view('mastercard.success');
    }

    /**
     * Handle Payment Cancel
     */
    public function paymentCancel(Request $request)
    {
        return view('mastercard.cancel');
    }
}
