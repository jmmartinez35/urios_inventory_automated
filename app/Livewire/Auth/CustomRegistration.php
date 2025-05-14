<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class CustomRegistration extends Component
{
    public $username, $email, $password, $password_confirmation;

    public function render()
    {
        return view('livewire.auth.custom-registration');
    }

    public function registerCustom()
    {
        $data = $this->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'status' => "incompleted",
            'user_status' => 1,
            'password' => Hash::make($data['password']),
        ]);

        $this->dispatch('messageModal', status: 'info', position: 'top', message: 'Register successfully. Please wait for administrator approval. Thank you!.');
        $this->dispatch('redirectWithDelay', url: '/', delay: 3000);
            
    }
}
