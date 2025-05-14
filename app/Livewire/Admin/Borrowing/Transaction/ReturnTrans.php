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
use App\Models\DamagedItem;

class ReturnTrans extends Component
{
    public $barcode;
    public $remarks_msg;
    public $userDetails, $users, $borrowDetails;
    public $cartList;
    public $item_qty = [];
    public $remainingDays = 0;
    public $overdueDays = 0;

    public $damageNotes = [];
    public $damagedQuantities = [];


    public function mount()
    {
        $this->cartList = collect();
    }


    public function continueWithRestriction()
    {
        $this->completeBorrowing();
    }

    public function continueRemoveRestriction()
    {

        $this->users->update([
            'user_status' => 0,
            'restricted_until' => Null,
        ]);
        $this->completeBorrowing();
    }


    public function processBarcode($barcode)
    {

        if (empty($barcode)) {
            // $this->resetData();
            return;
        }
        if (!preg_match('/^C\d{5}$/', $barcode)) {
            $this->dispatch('saveModal', status: 'warning', position: 'top', message: 'Invalid barcode format.');
            return;
        }

        if ($barcode) {
            $borr = BorrowingReturn::where('barcode_return', $barcode)->first();

            if ($borr) {
                $borrow = Borrowing::where('id', $borr->borrowing_id)->where('status', 1)->first();
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

                    if ($borrow->end_date) {
                        $dueDate = Carbon::parse($borrow->end_date);
                        $now = Carbon::now();

                        if ($now->greaterThan($dueDate)) {
                            $this->overdueDays = $dueDate->diffInDays($now);
                            $this->remainingDays = 0;
                        } else {
                            $this->remainingDays = $now->diffInDays($dueDate);
                            $this->overdueDays = 0;
                        }
                    }
                } else {
                    $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Borrowing record not found or already processed.');
                    $this->resetData();
                    $this->cartList = collect();
                }
            }
        }

        $this->reset('barcode');
    }


    public function completeBorrowing()
    {
        if (!$this->borrowDetails) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'No borrowing record found. Please scan a valid barcode.');
            return;
        }

        $borrow = Borrowing::find($this->borrowDetails->id);
        if ($borrow && $borrow->status !== 3) {
            $hasDamagedItems = false;

            foreach ($this->cartList as $cart) {
                $item = $cart->item;
                $borrowedQty = $cart->quantity;
                $damagedQty = (int) ($this->damagedQuantities[$item->id] ?? 0);

                if ($damagedQty > $borrowedQty) {
                    $this->dispatch('messageModal', status: 'error', position: 'top', message: "Damaged quantity for {$item->name} exceeds borrowed quantity.");
                    return; // ⛔ Stop here, modal won't close
                }

                $note = $this->damageNotes[$item->id] ?? 'Reported on return';
                $returnedQty = $borrowedQty - $damagedQty;

                if ($returnedQty > 0) {
                    $item->increment('quantity', $returnedQty);
                }

                if ($damagedQty > 0) {
                    DamagedItem::create([
                        'borrowing_id' => $borrow->id,
                        'item_id' => $item->id,
                        'quantity' => $damagedQty,
                        'note' => $note,
                    ]);
                    $hasDamagedItems = true;
                }
            }

            $borrow->update(['status' => 3, 'approved_by' => Auth::id()]);
            $this->borrowDetails->status = 3;

            if ($borrow->borrowingReturn) {
                $borrow->borrowingReturn->update([
                    'returned_at' => now(),
                    'notes' => $hasDamagedItems ? 'Items returned with damage' : 'All items returned in good condition',
                ]);
            }

            $message = $hasDamagedItems
                ? 'Borrowing completed. Damaged items recorded.'
                : 'Borrowing completed successfully. No damage reported.';

            // ✅ Only dispatch modal close if all OK
            $this->dispatch('destroyModal', status: 'success', position: 'top', message: $message, modal: '#confirmMarkDoneModal');
            $this->resetData();
        } else {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Already completed or not found.');
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
        $this->remainingDays = 0;
        $this->overdueDays = 0;
        // $this->dispatch('messageModal', status: 'info', position: 'top', message: 'Data has been reset.');
    }





    public function render()
    {
        return view('livewire.admin.borrowing.transaction.return-trans', [
            'userDetails' => $this->userDetails,
            'user' => $this->users,
            'borrowDetails' => $this->borrowDetails,
            'cartList' => $this->cartList
        ]);
    }
}
