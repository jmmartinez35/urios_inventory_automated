<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home'); // Redirect to home page
        }
        return view('auth.login');
    }


}
