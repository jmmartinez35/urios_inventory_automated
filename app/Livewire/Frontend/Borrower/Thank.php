<?php

namespace App\Livewire\Frontend\Borrower;

use App\Models\Borrowing;
use App\Models\Borrowing_cart;
use App\Models\Item;
use App\Models\User;
use App\Notifications\CustomerNotification;
use Illuminate\Support\Facades\Notification;

use Carbon\Carbon;
use Livewire\Component;

class Thank extends Component
{
    public $bor_id, $expire_status = false;
    public $details;

    public function mount($details)
    {
        $currentDate = Carbon::now();

        if ($details) {
            $this->details =  $details;

            $returnDate = Carbon::parse($this->details->date_from);
            $this->bor_id = $this->details->id;

            if ($currentDate->isSameDay($returnDate)) {
                $this->expire_status = true;
            }
        }
    }

    public function cancelBorrow()
    {

        $items = Borrowing_cart::where('borrowing_id', $this->bor_id)->get();

        $borrowing = Borrowing::where('id', $this->bor_id)->first();
        $users = User::where('id', $borrowing->users->id)->first();
        $admin = User::where('role_as', 1)->first();
        $borrowing->update([
            'status' => 2,
        ]);

        //     $link = route('reservation.pending');
        //     $details = [
        //         'greeting' => "Reservation Cancelled",
        //         'body' => "The reservation has been cancelled by the $users->username. .",
        //         'lastline' => '',
        //         'regards' => "Login to admin panel now?: $link"
        //     ];

        //     Notification::send($admin, new CustomerNotification($details));
            $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Borrowing request canceleed successfully.');
            return redirect()->route('cart.status', ['uuid' => $borrowing->uuid]);
        
    }

    public function render()
    {

        return view('livewire.frontend.borrower.thank', ['expire_status' => $this->expire_status]);
    }
}
