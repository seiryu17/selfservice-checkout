<?php

namespace App\Http\Livewire;

use App\Models\cart;
use App\Models\InventoryItems;
use Livewire\Component;
use Auth;

class CartCreate extends Component
{
    public $barcode;
    
    public function render()
    {
        return view('livewire.cart-create');
    }

    public function store(){

        $this->validate([
            'barcode' => 'required|exists:inventory_items,kode'
        ]);

        $a = 1;
        $item = InventoryItems::where('kode', $this->barcode)->firstOrFail();
        $cart = cart::where('item_id', $item->id)
        ->where('created_by', Auth::user()->name)
        ->first();
        if($cart){
            $cart->quantity = $cart->quantity+1;
            $cart->save();
        }else{
            $cart = cart::create([
                'item_id' => $item->id,
                'quantity' => $a,
                'created_by' => Auth::user()->name
            ]);
        }
        $this->resetInput();

        $this->emit('cartStored', $cart);
    }

    private function resetInput(){
        $this->barcode = null;
    }
}
