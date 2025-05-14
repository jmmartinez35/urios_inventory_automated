<?php

namespace App\Livewire\Frontend\Account;

use App\Models\Borrowing;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();

        $borrow_pending = Borrowing::where('user_id', $user->id)
            ->where('status', 0)
            ->count();

        $borrow_total = Borrowing::where('user_id', $user->id)
            ->count();

        $borrow_cancel = Borrowing::where('user_id', $user->id)
            ->where('status', 2)
            ->count();


        return view('livewire.frontend.account.dashboard', compact(
            'borrow_pending',
            'borrow_total',
            'borrow_cancel'
        ));
    }
}
