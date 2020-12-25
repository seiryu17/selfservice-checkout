<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id','quantity','created_by'
    ];

    public function itemscart(){
        return $this->belongsTo(InventoryItems::class,'item_id','id');
    }

    protected $table = 'cart';
}
