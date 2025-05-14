<?php

namespace App\Livewire\Frontend\Search;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;

class Results extends Component
{
    public $query;
    public $items = [];

    public function mount()
    {
        // Get search query from request
        $this->query = request()->query('q', '');

        // Fetch filtered results
        $this->items = Item::where('name', 'like', '%' . $this->query . '%')
            ->orWhere('description', 'like', '%' . $this->query . '%')
            ->get();
    }

    public function render()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();

        return view('livewire.frontend.search.results', ['categories' => $categories, 'items' => $this->items]);
    }
}
