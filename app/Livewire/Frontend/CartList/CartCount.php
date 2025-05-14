<?php

namespace App\Livewire\Frontend\CartList;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartCount extends Component
{
    public $cartlisCount;
    protected $listeners = ['cartlistAddedUpdated' => 'checkCartlistCount'];
    public function checkCartlistCount()
    {
        if (Auth::check()) {
            return $this->cartlisCount = Cart::where('user_id', auth()->user()->id)->where('status', 0)->count();
        } else {
            return  $this->cartlisCount = 0;
        }
    }

    public function render()
    {
        $this->cartlisCount = $this->checkCartlistCount();

        return view('livewire.frontend.cart-list.cart-count', ['cartlisCount' => $this->cartlisCount]);
    }
}
