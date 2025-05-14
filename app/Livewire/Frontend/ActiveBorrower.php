<?php

namespace App\Livewire\Frontend;

use App\Models\Item;
use Livewire\Component;

class ActiveBorrower extends Component
{

    public $item;
    public $borrowings;

    public function mount(Item $item)
    {
        $this->item = $item;

        $this->borrowings = \App\Models\Borrowing::where('status', 1)
            ->whereHas('borrowingCarts.cart', function ($query) use ($item) {
                $query->where('item_id', $item->id);
            })
            ->with(['users.userDetail', 'borrowingCarts.cart' => function ($query) use ($item) {
                $query->where('item_id', $item->id);
            }])
            ->get()
            ->filter(function ($borrowing) use ($item) {
                return $borrowing->borrowingCarts->contains(function ($cartRel) use ($item) {
                    return optional($cartRel->cart)->item_id === $item->id;
                });
            });
    }


    public function obfuscateName($user)
    {
        if (!$user || !$user->userDetail) return '';

        $first = $user->userDetail->firstname;
        $last = $user->userDetail->lastname;

        $firstMasked = substr($first, 0, 1) . str_repeat('*', strlen($first) - 1);
        $lastShort = substr($last, 0, 4);

        return $firstMasked . '**' . $lastShort;
    }


    public function render()
    {
        $borrowings = $this->borrowings;

        return view('livewire.frontend.active-borrower', compact('borrowings'));
    }
}
