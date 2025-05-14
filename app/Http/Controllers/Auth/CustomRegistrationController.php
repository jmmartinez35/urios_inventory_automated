<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomRegistrationController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home'); // Redirect to home page
        }
        return view('auth.register');
    }

}
