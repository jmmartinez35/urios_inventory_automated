<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class Pending extends Component
{
    public  $id;


    public function render()
    {
        $usersList = User::where('role_as', '0')->where('user_status', '1')->get();
        return view('livewire.admin.user.pending', ['usersList' => $usersList]);
    }

    public function userID($id)
    {
        $this->id = $id;
    }

    public function userApproved()
    {

        $user = User::findOrFail($this->id);

        if ($user) {
            $user->update(['user_status' => 0]);

            $this->dispatch('destroyModal', status: 'success', position: 'top', message: 'User approved successfully.', modal: '#userAModal');
        }
    }

    public function userDeclined()
    {
        $user = User::findOrFail($this->id);

        if ($user) {
            $user->update(['user_status' => 1]);

            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'User declined successfully.', modal: '#userDModal');
        }
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
    }
}
