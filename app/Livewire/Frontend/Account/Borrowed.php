<?php

namespace App\Livewire\Frontend\Account;

use App\Models\Borrowing;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithoutUrlPagination as LivewireWithoutUrlPagination;
use Livewire\WithPagination as LivewireWithPagination;
use WithPagination, WithoutUrlPagination;

class Borrowed extends Component
{
    protected $PerPage = 3;

    use LivewireWithPagination, LivewireWithoutUrlPagination;

    public function render()
    {
        $borrow_pending = Borrowing::where('status', 0)->where('user_id', Auth::id())->paginate($this->PerPage, pageName: 'pending-page');
        $borrow_approved = Borrowing::where('status', 1)->where('user_id', Auth::id())->paginate($this->PerPage, pageName: 'approved-page');
        $borrow_cancel = Borrowing::where('status', 2)->where('user_id', Auth::id())->paginate($this->PerPage, pageName: 'cancel-page');
        $borrow_complete = Borrowing::where('status', 3)->where('user_id', Auth::id())->paginate($this->PerPage, pageName: 'complete-page');

        return view('livewire.frontend.account.borrowed', compact('borrow_pending','borrow_approved', 'borrow_cancel', 'borrow_complete'));
    }
}
