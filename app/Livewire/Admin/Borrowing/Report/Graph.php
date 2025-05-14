<?php

namespace App\Livewire\Admin\Borrowing\Report;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Graph extends Component
{
    public $selectedMonth;

    public function mount()
    {
        // Load current month by default
        $this->selectedMonth = now()->month;
    }

    public function render()
    {
        return view('livewire.admin.borrowing.report.graph', [
            'itemNames' => $this->getItemNames(),
            'borrowCounts' => $this->getBorrowCounts(),
        ]);
    }

    public function updatedSelectedMonth()
    {
        $this->dispatch('renderChart', [
            'itemNames' => $this->getItemNames()->values(),
            'borrowCounts' => $this->getBorrowCounts()->values(),
            'selectedMonth' => $this->selectedMonth,
        ]);
    }

    private function getFrequentItems()
    {
        $query = DB::table('borrowing_cart')
            ->join('cart', 'borrowing_cart.cart_id', '=', 'cart.id')
            ->join('items', 'cart.item_id', '=', 'items.id')
            ->join('borrowing', 'borrowing_cart.borrowing_id', '=', 'borrowing.id')
            ->select('items.name', DB::raw('COUNT(items.id) as total_borrowed'))
            ->where('borrowing.status', 3) // Only completed borrowings
            ->groupBy('items.id', 'items.name')
            ->orderByDesc('total_borrowed');

        if ($this->selectedMonth) {
            $query->whereMonth('borrowing.created_at', $this->selectedMonth);
        }

        return $query->get();
    }

    private function getItemNames()
    {
        return $this->getFrequentItems()->pluck('name');
    }

    private function getBorrowCounts()
    {
        return $this->getFrequentItems()->pluck('total_borrowed');
    }
}
