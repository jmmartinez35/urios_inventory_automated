<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Borrowing;
use Carbon\Carbon;


class DashboardGraph extends Component
{
    public function render()
    {


        // Monthly Borrowing Data
        $monthlyData = Borrowing::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('status', 3)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $monthlyCounts = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 1));
            $monthlyCounts[] = $monthlyData->firstWhere('month', $i)->count ?? 0;
        }

        // Most Frequently Borrowed Items
        $frequentItems = DB::table('borrowing_cart')
            ->join('borrowing', 'borrowing_cart.borrowing_id', '=', 'borrowing.id')
            ->join('cart', 'borrowing_cart.cart_id', '=', 'cart.id')
            ->join('items', 'cart.item_id', '=', 'items.id')
            ->select('items.name', DB::raw('COUNT(items.id) as total_borrowed'))
            ->where('borrowing.status', 3) // Only completed borrowings
            ->whereMonth('borrowing_cart.created_at', Carbon::now()->month)
            ->whereYear('borrowing_cart.created_at', Carbon::now()->year)
            ->groupBy('items.id', 'items.name')
            ->orderByDesc('total_borrowed')
            ->limit(5)
            ->get();


        $itemNames = $frequentItems->pluck('name');
        $borrowCounts = $frequentItems->pluck('total_borrowed');


        return view('livewire.admin.dashboard.dashboard-graph', [
            'months' => $months,
            'monthlyCounts' => $monthlyCounts,
            'itemNames' => $itemNames,
            'borrowCounts' => $borrowCounts,
        ]);
    }
}
