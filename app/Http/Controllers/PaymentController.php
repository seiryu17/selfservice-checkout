<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\cart;
use Alert;
use Auth;
class PaymentController extends Controller
{
    public function notification(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

		$validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . env('MIDTRANS_SERVER_KEY'));
        if($notification->signature_key != $validSignatureKey){
            return response(['message' => 'Invalid signature'],403);
        }
        $this->initPaymentGateway();
        $statusCode = null;

        $paymentNotification = new \Midtrans\Notification();
        $order = Transaction::where('uuid', $paymentNotification->order_id)->firstOrFail();

        if($order->isPaid()){
            return response(['message' => 'The order has been paid before'],422);
        }

        $transaction = $paymentNotification->transaction_status;
		$type = $paymentNotification->payment_type;
		$orderId = $paymentNotification->order_id;
		$fraud = $paymentNotification->fraud_status;

        $vaNumber = null;
		$vendorName = null;
		if (!empty($paymentNotification->va_numbers[0])) {
			$vaNumber = $paymentNotification->va_numbers[0]->va_number;
			$vendorName = $paymentNotification->va_numbers[0]->bank;
		}

        $paymentStatus = null;
		if ($transaction == 'capture') {
			// For credit card transaction, we need to check whether transaction is challenge by FDS or not
			if ($type == 'credit_card') {
				if ($fraud == 'challenge') {
					// TODO set payment status in merchant's database to 'Challenge by FDS'
					// TODO merchant should decide whether this transaction is authorized or not in MAP
					$paymentStatus = Payment::CHALLENGE;
				} else {
					// TODO set payment status in merchant's database to 'Success'
					$paymentStatus = Payment::SUCCESS;
				}
			}
		} else if ($transaction == 'settlement') {
			// TODO set payment status in merchant's database to 'Settlement'
			$paymentStatus = Payment::SETTLEMENT;
		} else if ($transaction == 'pending') {
			// TODO set payment status in merchant's database to 'Pending'
			$paymentStatus = Payment::PENDING;
		} else if ($transaction == 'deny') {
			// TODO set payment status in merchant's database to 'Denied'
			$paymentStatus = PAYMENT::DENY;
		} else if ($transaction == 'expire') {
			// TODO set payment status in merchant's database to 'expire'
			$paymentStatus = PAYMENT::EXPIRE;
		} else if ($transaction == 'cancel') {
			// TODO set payment status in merchant's database to 'Denied'
			$paymentStatus = PAYMENT::CANCEL;
		}

        $paymentParams = [
			'transaction_id' => $order->id,
			'number' => Payment::generateCode(),
			'amount' => $paymentNotification->gross_amount,
			'method' => 'midtrans',
			'status' => $paymentStatus,
			'token' => $paymentNotification->transaction_id,
			'payloads' => $payload,
			'payment_type' => $paymentNotification->payment_type,
			'va_number' => $vaNumber,
			'vendor_name' => $vendorName,
			'biller_code' => $paymentNotification->biller_code,
			'bill_key' => $paymentNotification->bill_key,
		];
        
        $payment = Payment::create($paymentParams);
        
        if($paymentStatus && $payment){
           if(in_array($payment->status,[Payment::SUCCESS, Payment::SETTLEMENT])){
            $order->payment_status = Transaction::PAID;
            $order->save();
        }
        }
        
        $message = 'Payment status is : '. $paymentStatus;

        $response = [
            'code' => 200,
            'message' => $message
        ];

        return response($response,200);

    }

    public function finish(Request $request)
    {
		$uuid = $request->query('order_id');
		$transaction = Transaction::where('uuid', $uuid)->firstOrFail();

		if($transaction->payment_status == Transaction::UNPAID){
			Alert::warning('Pembayaran gagal', 'Mohon ulangi pembayaran');
			$transaction->payment_status = Transaction::FAILED;
			$transaction->save();
			return redirect()->route('index');
		}
		cart::where('created_by',Auth::user()->name)->delete();
		return view('notify.success');
    }
    
    public function unfinish(Request $request)
    {
		$uuid = $request->query('order_id');
		$transaction = Transaction::where('uuid', $uuid)->firstOrFail();
		Alert::warning('Pembayaran gagal', 'Mohon ulangi pembayaran');
		$transaction->payment_status = Transaction::FAILED;
		$transaction->save();
		return redirect()->route('index');
    } 

    public function failed(Request $request)
    {
		$uuid = $request->query('order_id');
		$transaction = Transaction::where('uuid', $uuid)->firstOrFail();
		Alert::warning('Pembayaran gagal', 'Mohon ulangi pembayaran');
		$transaction->payment_status = Transaction::FAILED;
		$transaction->save();
		return redirect()->route('index');
    }


}
