<?php

namespace App\Livewire\Admin\Borrowing\Transaction;

use App\Models\Borrowing;
use App\Models\Borrowing_cart;
use App\Models\BorrowingReturn;
use App\Models\Cart;
use App\Models\Remarks;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CustomerNotification;
use Illuminate\Support\Facades\Notification;

class Online extends Component
{
    public $barcode;
    public $remarks_msg;
    public $userDetails, $users, $borrowDetails;
    public $cartList;
    public $item_qty = [];

    protected $listeners = ['barcode-scanned' => 'processBarcode'];

    public function mount()
    {
        $this->cartList = collect();
    }

    public function testD()
    {
        $this->dispatch('userStatusUpdatedJS');
        $this->dispatch('userStatusUpdated')->to(\App\Livewire\Frontend\Borrower\Status::class);
    }
    public function processBarcode($barcode)
    {


        if (empty($barcode)) {
            // $this->resetData();
            return;
        }
        if (!preg_match('/^B\d{5}$/', $barcode)) {
            $this->dispatch('saveModal', status: 'warning', position: 'top', message: 'Invalid barcode format.');
            return;
        }

        if ($barcode) {
            $borrow = Borrowing::where('barcode_reference', $barcode)->where('status', 0)->first(); // Only process pending borrowings

            if ($borrow && $borrow->users) {
                $user = User::where('id', $borrow->user_id)->first();
                if ($user) {
                    $this->userDetails = $user->userDetails->first();
                    $this->users = $user;
                }
                $borrowCart = Borrowing_cart::where('borrowing_id', $borrow->id)->get();

                if ($borrowCart->isNotEmpty()) {
                    $cartIds = $borrowCart->pluck('cart_id')->toArray();

                    $this->cartList = Cart::whereIn('id', $cartIds)->get();

                    foreach ($this->cartList as $cart) {
                        $this->item_qty[$cart->id] = $cart->quantity;
                    }
                } else {
                    $this->cartList = collect();
                }


                $this->borrowDetails = $borrow;
            } else {
                $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Borrowing record not found or already processed.');
                $this->resetData();
                $this->cartList = collect();
            }
        }

        $this->reset('barcode');
    }

    public function isApprovalDisabled()
    {
        if (!$this->borrowDetails) {
            return true;
        }

        foreach ($this->cartList as $cart) {
            $data = Cart::find($cart->id);


            if ($data && $data->quantity > $data->item->quantity) {
                return true;
            }
        }

        return false;
    }


    public function removeItemFromCart($id)
    {
        if ($this->cartList->count() > 1) {

            Cart::where('id', $id)->delete();

            $this->refreshCartList();
            $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Item removed from cart.');
        } else {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Cannot remove the last item. At least one item must remain in the cart.');
        }
    }

    private function refreshCartList()
    {
        if ($this->borrowDetails) {
            $borrowCart = Borrowing_cart::where('borrowing_id', $this->borrowDetails->id)->get();

            if ($borrowCart->isNotEmpty()) {
                $cartIds = $borrowCart->pluck('cart_id')->toArray();
                $this->cartList = Cart::whereIn('id', $cartIds)->get();

                foreach ($this->cartList as $cart) {
                    $this->item_qty[$cart->id] = $cart->quantity; // Ensure UI updates
                }
            } else {
                $this->cartList = collect();
                $this->item_qty = []; // Reset if no items exist
            }
        }
    }



    public function approveBorrowing()
    {
        if (!$this->borrowDetails) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'No borrowing record found. Please scan a valid barcode.');
            return;
        }

        if ($this->isApprovalDisabled()) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Approval failed: Insufficient stock for one or more items.');
            return;
        }

        $borrow = Borrowing::find($this->borrowDetails->id);
        if ($borrow && $borrow->status !== 1) {
            // Reduce item stock quantity
            foreach ($this->cartList as $cart) {
                $item = $cart->item;
                if ($item) {
                    $item->decrement('quantity', $cart->quantity);
                }
            }

            $borrow->update(['status' => 1, 'approved_by' => Auth::id()]);

            $this->borrowDetails->status = 1;

            BorrowingReturn::create([
                'borrowing_id' => $borrow->id,
                'notes' => 'Initial approval',
            ]);

            $users = User::find($borrow->user_id);

            $link = route('cart.status', ['uuid' => $borrow->uuid]);
            $details = [
                'greeting' => "Borrowing Approved",
                'body' => "Your borrowing request has been approved by the administrator.",
                'lastline' => '',
                'regards' => "Please visit: $link"
            ];

            Notification::send($users, new CustomerNotification($details));

            $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Borrowing request approved. Stock updated.');
            $this->resetData();
        } else {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'This request has already been approved or does not exist.');
        }
    }

    public function declinedBorrowing()
    {

        if (!$this->borrowDetails) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'No borrowing record found.');
            return;
        }

        $borrow = Borrowing::find($this->borrowDetails->id);
        if ($borrow && $borrow->status !== 2) {
            $borrow->update(['status' => 2, 'approved_by' => Auth::id()]);

            if ($this->remarks_msg) {
                Remarks::create([
                    'remarks_msg' => $this->remarks_msg,
                    'borrowing_id' => $borrow->id,
                ]);
            }

            $this->borrowDetails->status = 2;


            $users = User::find($borrow->user_id);

            $link = route('cart.status', ['uuid' => $borrow->uuid]);
            $details = [
                'greeting' => "Borrowing Approved",
                'body' => "Your borrowing request  has been cancelled by the administrator. For more information, please visit the office. . <br> Sorry for the inconvenience.",
                'lastline' => '',
                'regards' => "Please visit: $link"
            ];

            Notification::send($users, new CustomerNotification($details));


            $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Borrowing Declined.');
            $this->resetData();
        } else {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Already declined or not found.');
        }
    }


    public function resetData()
    {
        $this->barcode = null;
        $this->userDetails = null;
        $this->users = null;
        $this->borrowDetails = null;
        $this->cartList = collect();
        $this->item_qty = [];

        // $this->dispatch('messageModal', status: 'info', position: 'top', message: 'Data has been reset.');
    }


    public function render()
    {
        return view('livewire.admin.borrowing.transaction.online', [
            'userDetails' => $this->userDetails,
            'user' => $this->users,
            'borrowDetails' => $this->borrowDetails,
            'cartList' => $this->cartList
        ]);
    }
}
