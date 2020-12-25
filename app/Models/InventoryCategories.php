<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCategories extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'category'
    ];

    public function itemsCategory(){
        return $this->hasMany(InventoryItems::class,'category_id');
     }

    protected $table = 'inventory_categories';

}
