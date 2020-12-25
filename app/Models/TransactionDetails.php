<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TransactionDetails extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'transaction_id','item_id','quantity'
      ];

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }
}
