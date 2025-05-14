<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Item;
use App\Models\User;
use App\Services\BorrowingService;

class DashboardController extends Controller
{
    protected $borrowingService;

    public function __construct(BorrowingService $borrowingService)
    {
        $this->borrowingService = $borrowingService;
    }

    public function index()
    {
        $this->borrowingService->removeRestrictionsForClearedUsers();
       
        $this->borrowingService->autoCancelBorrowings();
        $this->borrowingService->sendBorrowingDeadlineReminders();
        $userPending = User::where('user_status', 1)->count();
        $user = User::where('role_as', 0)->count();

        $borrow_pending = Borrowing::where('status', 0)->count();
        $borrow_approved = Borrowing::where('status', 1)->count();
        $borrow_cancel = Borrowing::where('status', 2)->count();

        $items = Item::count();



        return view('admin.dashboard', compact('items', 'userPending', 'borrow_pending', 'borrow_approved', 'borrow_cancel', 'user'));
    }

    public function category()
    {
        return view('admin.category.index');
    }

    public function items()
    {
        return view('admin.items.index');
    }

    public function barcode()
    {
        return view('admin.items.barcode');
    }
}
