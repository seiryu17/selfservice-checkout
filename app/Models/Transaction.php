<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
      'uuid','name','number','email','transaction_total','payment_status','created_by'
    ];

    public function details(){
      return $this->hasMany(TransactionDetails::class,'transaction_id');
   }

   public const PAID = 'paid';
   public const UNPAID = 'unpaid';
   public const FAILED = 'failed';

   public function isPaid(){
    return $this->payment_status == self::PAID;
}
}
