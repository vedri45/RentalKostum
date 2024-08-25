<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\CoreApi;

class PaymentService
{
    public function __construct()
    {
        Config::$serverKey = config('payment.midtrans.server_key');
        Config::$isProduction = config('payment.midtrans.is_production');
        Config::$isSanitized = config('payment.midtrans.is_sanitized');
        Config::$is3ds = config('payment.midtrans.is_3ds');
    }

    public function createTransaction($orderId, $amount, $costumeId, $customerId, $customerDetails, $itemDetails)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $amount,
            ],
            'customer_details' => $customerDetails,
            'item_details' => $itemDetails,
            'callbacks' => [
                'finish' => route('payment.callback', [
                    'costume_id' => $costumeId,
                    'customer_id' => $customerId,
                ])
            ]
        ];

        return Snap::createTransaction($params)->redirect_url;
    }
}