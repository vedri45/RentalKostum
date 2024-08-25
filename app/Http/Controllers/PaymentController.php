<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Costume;
use App\Customer;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
        $this->guzzleClient = new Client();
    }

    public function createPayment(Request $request)
    {
        $orderId = uniqid();
        $amount = $request->input('amount');
        $costumeId = $request->input('costume_id');
        $customerId = $request->input('customer_id');

        $customerDetails = [
            'first_name' => $request->input('first_name'),
            'phone'      => $request->input('phone'),
            'address'    => $request->input('address'),
        ];
        $itemDetails = [
            [
                'id' => $request->input('costume_id'),
                'price' => $amount,
                'quantity' => 1,
                'name' => $request->input('name')
            ]
        ];

        $paymentUrl = $this->paymentService->createTransaction($orderId, $amount, $costumeId, $customerId, $customerDetails, $itemDetails);

        return redirect($paymentUrl);
    }

    public function handleCallback(Request $request)
    {
        // Retrieve the callback data
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $transactionStatus = $request->input('transaction_status');
        $costumeId = $request->input('costume_id');
        $customerId = $request->input('customer_id');

        // Send a POST request to the store method using Guzzle
        try {
            $response = $this->guzzleClient->post(route('payment.store'), [
                'form_params' => [
                    'order_id' => $orderId,
                    'status_code' => $statusCode,
                    'transaction_status' => $transactionStatus,
                    'costume_id' => $costumeId,
                    'customer_id' => $customerId,
                ]
            ]);

            // Check response status
            if ($response->getStatusCode() == 200) {
                return response()->json(['success' => true, 'message' => 'Payment successful']);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to handle callback'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        // Extract data from the request
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $transactionStatus = $request->input('transaction_status');
        $costumeId = $request->input('costume_id');
        $customerId = $request->input('customer_id');

        DB::beginTransaction();
        try {
            // Find the costume and customer
            $costume = Costume::findOrFail($costumeId);
            $customer = Customer::findOrFail($customerId);

            // Set rent_date to the current date
            $rentDate = Carbon::now();

            // Set back_date to 3 days after the rent_date
            $backDate = $rentDate->copy()->addDays(3);

            $price = $costume->price;
            $amount = $rentDate->diffInDays($backDate) * $price;

            // Prepare transaction data
            $data_transaction = [
                'invoice_no' => $this->generateInvoice(now()->format('Y-m-d')), // Use Carbon for current date
                'costume_id' => $costume->id,
                'customer_id' => $customer->id,
                'rent_date' => $rentDate,
                'back_date' => $backDate,
                'price' => $price,
                'amount' => $amount,
                'status' => 'proses',
            ];

            // Create transaction and update costume status
            $transaction = Transaction::create($data_transaction);
            $costume->update(['status' => 'terpakai']);

            // Commit transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback transaction in case of an error
            DB::rollback();
            return redirect()->back()->with('error-message', $e->getMessage());
        }
    }

    private function generateInvoice($date){
        $tanggal = substr($date, 8, 2);
        $bulan = substr($date, 5, 2);
        $tahun = substr($date, 2, 2);
        $transactionCount = Transaction::whereDate('created_at', $date)->count();
        $no = 'TRX-' . $tanggal . $bulan . $tahun . '-' . sprintf('%05s', $transactionCount + 1);
        return $no;
    }
}