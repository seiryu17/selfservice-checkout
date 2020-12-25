<?php

namespace App\Http\Livewire;
use App\Models\cart;
use Livewire\Component;
use Auth;

class CartDetails extends Component
{
    public $listeners = [
        'cartStored' => 'handleStored'
    ];

    public function handleStored($cart){
        
    }

    public function render()
    {   $total = 0;
        $items = cart::with('itemscart')->where('created_by',Auth::user()->name)->get();
        foreach($items as $item){
            $total += $item->quantity * $item->itemscart->price;
        }
        return view('livewire.cart-details')->with([
            'total' => $total
        ]);

        $this->emit('cartStored', $items);
    }
}
