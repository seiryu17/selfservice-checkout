<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class InventoryItems extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'brand_id','category_id','name','description','price','quantity','kode'
    ];
    
    public function brand(){
        return $this->belongsTo(InventoryBrand::class,'brand_id','id');
    }

    public function category(){
        return $this->belongsTo(InventoryCategories::class,'category_id','id');
    }

    public function cart(){
        return $this->hasMany(cart::class,'item_id');
     }

    protected $table = 'inventory_items';
}
