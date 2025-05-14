<?php

namespace App\Livewire\Frontend\Borrower;

use App\Models\Borrowing_cart;
use App\Models\Cart;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Thank1 extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $borrowID;
    public $item_qty = [];
    public $editMode = false;

    public function mount($borID)
    {
        $this->borrowID = $borID;
        $items = Cart::where('item_id', $this->borrowID)->get();
        foreach ($items as $item) {
            $this->item_qty[$item->id] = $item->quantity; 
        }
    }

   
    public function render()
    {
        $item = Borrowing_cart::where('borrowing_id', $this->borrowID)->paginate(5, pageName: 'Item-page');
      
        return view('livewire.frontend.borrower.thank1', ['item' => $item]);
    }
}
