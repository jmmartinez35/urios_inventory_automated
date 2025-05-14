<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExpirationChecker;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
       
        return view('frontend.account.dashboard');
    }

    public function profile()
    {
        return view('frontend.account.profile');
    }

    public function borrowed()
    {
        return view('frontend.account.borrowed');
    }
}
