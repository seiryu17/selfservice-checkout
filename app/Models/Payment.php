<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
		'number',
		'amount',
		'method',
		'status',
		'token',
		'payloads',
		'payment_type',
		'va_number',
		'vendor_name',
		'biller_code',
		'bill_key',
    ];

    public const PAYMENT_CHANNELS = [
    "credit_card", "cimb_clicks",
    "bca_klikbca", "echannel", "permata_va",
    "bca_va", "bni_va", "bri_va", "other_va", "gopay",
    "danamon_online", "akulaku", "shopeepay"
    ];

    public const EXPIRY_DURATION = 10;
    public const EXPIRY_UNIT = 'minutes';

    public const CHALLENGE = 'challenge';
    public const SUCCESS = 'success';
    public const SETTLEMENT = 'settlement';
    public const PENDING = 'pending';
    public const DENY = 'deny';
    public const EXPIRE = 'expire';
    public const CANCEL = 'cancel';

    public const PAYMENTCODE = 'TRX';

    public static function generateCode(){
        $uuid = self::PAYMENTCODE . mt_rand(10000,99999) . mt_rand(100,999);
        return  $uuid;
    }

    public static function _isOrderCodeExists($uuid){
        return self::where('number','=',$uuid)->exists();
    }

  
 }
