<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CustomLogin extends Component
{
    public $login, $password;

    public function render()
    {

        return view('livewire.auth.custom-login');

    }

    public function loginCustom() // Correct type-hinting for Request
    {
        $this->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginType = filter_var($this->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $this->login,
            'password' => $this->password,
        ];

        $user_check = User::where($loginType, $this->login)->first();

        if ($user_check) {

            if ($user_check->user_status == 0 || $user_check->user_status == 2) {
                if (Auth::attempt($credentials)) {
                    $user = Auth::user();

                    if ($user->role_as == '1') {
                        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Welcome to Dashboard.');
                        // return $this->redirect('/admin/dashboard', navigate: true);
                        return redirect('admin/dashboard');
                    } else {
                        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Logged In Successfully.');
                      //  return $this->redirect('/', navigate: true);
                        return redirect('/');

                    }
                }
            } elseif ($user_check->user_status == 1) {
                $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Your account is still pending; please contact the administrator or visit their office.');
                return false;
            }
        } else {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'User does not exist.');
            return back();
        }


        $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Invalid login credentials');
        return back();
    }
}
