<?php

namespace App\Livewire\Frontend\Borrower;

use Livewire\Component;

class Status extends Component
{
    public $borreturn, $remarks, $barcode, $borID, $users;
    public $borrower;
    protected $listeners = ['userStatusUpdated' => 'refreshStatus'];

   
    public function mount($details, $borreturn, $remarks, $barcode, $borID, $users)
    {
       
        $this->borID = $borID;
        $this->borreturn = $borreturn;
        $this->borrower = $details;
        $this->remarks = $remarks;
        $this->barcode = $barcode;
        $this->users = $users;
    }

    public function render()
    {
        return view('livewire.frontend.borrower.status', ['borreturn' => $this->borreturn, 'remarks' => $this->remarks, 'barcode' => $this->barcode, 'borID' => $this->borID, 'details' => $this->borrower, 'users' => $this->users]);
    }

    public function refreshStatus()
    {
        logger("✅ Event Received: Refreshing Status");
       
        dd("testing");
        
    }
}
