<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryBrand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function itemsBrand(){
        return $this->hasMany(InventoryItems::class,'brand_id');
     }

    protected $table = 'inventory_brands';

}
