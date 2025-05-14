<?php

namespace App\Livewire\Frontend\Search;

use Livewire\Component;

class Index extends Component
{
    public $query = ''; // Input for search

    public function search()
    {
        
        // Redirect to search results page with query parameter
        return redirect()->route('user.search', ['q' => $this->query]);
    }

    public function render()
    {
        return view('livewire.frontend.search.index');
    }
}
