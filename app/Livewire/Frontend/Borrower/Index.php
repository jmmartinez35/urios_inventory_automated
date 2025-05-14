<?php

namespace App\Livewire\Frontend\Borrower;

use App\Models\Borrowing;
use App\Models\Borrowing_cart;
use App\Models\Cart;
use App\Models\UserDetails;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Milon\Barcode\DNS1D;

class Index extends Component
{
    public $cart_list;
    public $item_qty = [];
    public $dsfrom, $dsto, $remarks;
    use WithPagination, WithoutUrlPagination;

    protected $cartPerPage = 5;

    public function mount()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $cart) {
            $this->item_qty[$cart->id] = $cart->quantity;
        }
    }


    public function decrementItemQuantity($id)
    {
        if (isset($this->item_qty[$id]) && $this->item_qty[$id] > 1) {
            $this->item_qty[$id]--;
            $this->updateCartQuantity($id, $this->item_qty[$id]);
        }
    }

    public function incrementItemQuantity($id)
    {
        $cartItem = Cart::find($id);

        if ($cartItem && isset($this->item_qty[$id]) && $this->item_qty[$id] <= $cartItem->quantity) {
            $this->item_qty[$id]++;

            $this->updateCartQuantity($id, $this->item_qty[$id]);
        }
    }

    public function updatedItemQty($value, $id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem) {
            $maxQuantity = $cartItem->quantity;
            if ($value < 1) {
                $this->item_qty[$id] = 1;
            } elseif ($value > $maxQuantity) {
                $this->item_qty[$id] = $maxQuantity;
            } else {
                $this->item_qty[$id] = $value;
            }

            $this->updateCartQuantity($id, $this->item_qty[$id]);
        }
    }

    public function handleInputItemChange($id, $value)
    {
        $this->updatedItemQty($value, $id);
    }

    private function updateCartQuantity($id, $quantity)
    {
        Cart::where('id', $id)->update(['quantity' => $quantity]);
        $this->dispatch('cartlistUpdated');
        $this->dispatch('cartlistAddedUpdated');
    }

    public function removeItemFromCart($id)
    {
        Cart::where('id', $id)->delete();

        $this->cart_list = Cart::where('user_id', Auth::id())->get();

        $this->dispatch('cartlistAddedUpdated');

        $this->dispatch('cartlistUpdated');
        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Item removed from cart.');
    }

    public function processBorrow()
    {

        $this->validate([
            'dsfrom' => 'required|date',
            'dsto' => 'required|date|after_or_equal:dsfrom',

            'remarks' => [
                'nullable',
                'string',
                'min:3',
                'max:255',
                'regex:/^(?!.*(\w)\1{2,}).+$/',
            ],
        ], [
            'dsfrom.required' => 'The date of usage (from) field is required.',
            'dsfrom.date' => 'The date of usage (from) must be a valid date.',
            'dsto.required' => 'The date of usage (to) field is required.',
            'dsto.date' => 'The date of usage (to) must be a valid date.',
            'dsto.after_or_equal' => 'The date of usage (to) must be after or equal to the date of usage (from).',

            'remarks.regex' => 'The remarks field cannot contain repeated characters.',
            'remarks.string' => 'The remarks must be a string.',
            'remarks.min' => 'The remarks must be at least :min characters.',
            'remarks.max' => 'The remarks may not be greater than :max characters.', // Added max message

        ]);

        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)
            ->where('status', 0)
            ->get();

        if ($cartItems->isEmpty()) {
            $this->dispatch('messageModal', status: 'error', position: 'top', message: 'Your cart is empty.');
            return;
        }

        $borrowing = Borrowing::create([
            'user_id' => $userId,
            'end_date' => $this->dsto,
            'start_date' => $this->dsfrom,
            'reason' => $this->remarks,
        ]);

        foreach ($cartItems as $cart) {
            Borrowing_cart::create([
                'borrowing_id' => $borrowing->id,
                'cart_id' => $cart->id,
            ]);

            $cart->update(['status' => 1]);
        }
        $this->dispatch('cartlistAddedUpdated');
        $this->dispatch('messageModal', status: 'success',  position: 'top', message: 'The borrowed was successfully placed. Please wait for the administrators confirmation via email or check the page.');
        return redirect()->route('cart.status', ['uuid' => $borrowing->uuid]);
        // Reset form fields
        $this->reset(['dsfrom', 'dsto', 'remarks']);
    }

    public function goBack()
    {
        return redirect()->route('home');
    }



    public function render()
    {
        $users = UserDetails::where('users_id', auth()->user()->id)->first();
        $cart = Cart::where('status', 0)->where('user_id', Auth::id())->paginate($this->cartPerPage, pageName: 'Cart-page');

        return view('livewire.frontend.borrower.index', [
            'carts' => $cart,
            'users' => $users
        ]);
    }
}
