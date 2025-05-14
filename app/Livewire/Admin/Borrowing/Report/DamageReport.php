<?php

namespace App\Livewire\Admin\Borrowing\Report;

use Livewire\Component;
use App\Models\DamagedItem;
use Illuminate\Support\Carbon;


class DamageReport extends Component
{

    public $selectedMonth = 'all';
    public $selectedWeek = 'all';

    public function updated($property)
    {
        if (in_array($property, ['selectedMonth', 'selectedWeek'])) {
            $this->render();
        }
    }


    public function getFilteredDamagesProperty()
    {
        $query = DamagedItem::with(['item', 'borrowing.users.userDetail']);

        if ($this->selectedMonth !== 'all') {
            $monthNumber = Carbon::parse("1 {$this->selectedMonth}")->month;
            $query->whereMonth('created_at', $monthNumber);
        }

        if ($this->selectedWeek !== 'all') {
            $query->whereRaw('WEEK(created_at, 1) - WEEK(DATE_SUB(created_at, INTERVAL DAYOFMONTH(created_at)-1 DAY), 1) + 1 = ?', [$this->selectedWeek]);
        }

        return $query->latest()->get();
    }


    public function render()
    {
        return view('livewire.admin.borrowing.report.damage-report', [
            'damagedItems' => $this->filteredDamages,
        ]);
    }
}
