<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use App\Models\InventoryItems;
use App\Models\Payment;
use App\Http\Requests\TransactionRequest;
use Alert;
use Auth;

class TransactionController extends Controller
{
    
    public function doCheckout(TransactionRequest $request){
        
         $data = $request->all();    
         $data['uuid'] = 'TRX' . mt_rand(10000,99999) . mt_rand(100,999);
         $data['payment_status'] = Transaction::UNPAID;
         $transaction = Transaction::create($data);
         $this->_generatePaymentToken($transaction);
         $transaction_details = cart::where('created_by',Auth::user()->name)->get();

         foreach ($transaction_details as $items) {
            $details[] = new TransactionDetails([
                'transactions_id' => $transaction->id,
                'item_id' => $items->item_id,
                'quantity' => $items->quantity
            ]);
            
            InventoryItems::find($items->item_id)->decrement('quantity',$items->quantity);
        }
        $transaction->details()->saveMany($details);
        

        return redirect()->to($transaction->payment_url);
    }

    private function _generatePaymentToken($transaction){
        $this->initPaymentGateway();
        $customerDetails = [
            'first_name' => $transaction->name,
            'phone' => $transaction->number,
            'email' => $transaction->email
        ];

        $params = [
            'enabled_payments' => \App\Models\Payment::PAYMENT_CHANNELS,
            'transaction_details' => [
                'order_id' => $transaction->uuid,
                'gross_amount' => $transaction->transaction_total
            ],
            'customer_details' => $customerDetails,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => \App\Models\Payment::EXPIRY_UNIT,
                'duration' => \App\Models\Payment::EXPIRY_DURATION,
            ],
        ];

        $snap = \Midtrans\Snap::createTransaction($params);
        if($snap->token){
            $transaction->payment_token = $snap->token;
            $transaction->payment_url = $snap->redirect_url;
            $transaction->save();
        }
    }
}
