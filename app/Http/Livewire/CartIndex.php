<?php

namespace App\Http\Livewire;

use App\Models\cart;
use Livewire\Component;
use Auth;

class CartIndex extends Component
{
    public $listeners = [
        'cartStored' => 'handleStored'
    ];

    public function render(){
        return view('livewire.cart-index',[
            'items' => cart::where('created_by', Auth::user()->name)->get()
        ]);
    }

    public function destroy($id){
        $data = cart::findOrFail($id);
        $data->delete();
        $this->emit('cartStored', $data);
    }

    public function handleStored($cart){
        
    }
    
}
