<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItemSuppliers extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'supplier_id','item_id','quantity_order','date_delivery'
    ];

    protected $table = 'inventory_item_suppliers';
}
