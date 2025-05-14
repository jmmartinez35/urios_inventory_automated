<?php

namespace App\Livewire\Admin\Items;

use App\Models\Item;
use Livewire\Component;

class Barcode extends Component
{
    public function render()
    {
        $items = Item::orderBy('created_at', 'DESC')->get();

        return view('livewire.admin.items.barcode', ['items'=>$items]);
    }
}
