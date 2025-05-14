<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Correct import statement
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) // Correct type-hinting for Request
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->input('login'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->user_status == 0 || $user->user_status == 2) {
                if ($user->role_as == '1') {
                    return redirect('admin/dashboard')->with('status', 'Welcome to Dashboard')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', '0');
                } else {

                    return redirect('/')->with('status', 'Logged In Successfully')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', '0');
                }
            } elseif ($user->user_status == 1){
                $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Your account is still pending; please contact the administrator or visit their office.');
                return false;
            }
        }

        return back()->withErrors(['login' => 'Invalid login credentials']);
    }
}
