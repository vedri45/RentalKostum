<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function createPayment(Request $request)
    {
        $orderId = uniqid();
        $amount = $request->input('amount');
        $customerDetails = [
            'first_name' => $request->input('first_name'),
            'phone'      => $request->input('phone'),
            'address'    => $request->input('address'),
        ];

        $paymentUrl = $this->paymentService->createTransaction($orderId, $amount, $customerDetails);

        return redirect($paymentUrl);
    }
}