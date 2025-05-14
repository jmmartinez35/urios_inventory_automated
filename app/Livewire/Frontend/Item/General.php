<?php

namespace App\Livewire\Frontend\Item;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class General extends Component
{

    public $items;

    public function mount($items)
    {
        $this->items = $items;
     
    }

    public $categories;
    public function render()
    {

        $this->categories = Category::orderBy('created_at', 'DESC')->get();
        return view('livewire.frontend.item.general', [
            'items' => $this->items, 
            'categories' => $this->categories
        ]);
    }
}
