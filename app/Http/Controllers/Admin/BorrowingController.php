<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function online()
    {
        return view('admin.borrowing.transaction.online.index');
    }

    public function history()
    {
        return view('admin.borrowing.history.index');
    }

    public function return()
    {
        return view('admin.borrowing.transaction.return.index');
    }

    public function reports()
    {
        return view('admin.borrowing.reports.index');
    }
}
