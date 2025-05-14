<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Hash;

class Management extends Component
{
    public  $id, $username, $email, $password, $old_password;
    public $editingStatus = null; // Keeps track of the item being edited
    public $itemStatus = null; // Holds the status to be updated

    public function render()
    {
        $usersList = User::where('role_as', '0')
        ->whereIn('user_status', [0, 2]) // Only Granted and Restricted
        ->get();
    

        return view('livewire.admin.user.management', ['usersList' => $usersList]);
    }
  
    public function editStatus($userId)
    {
        $this->editingStatus = $userId; // Set the ID of the user being edited
        $user = User::find($userId);
        $this->itemStatus = $user->user_status; // Set the current user status for editing
    }

    public function updateStatus($userId)
    {
        $user = User::find($userId);

        if ($user) {
            if ($this->itemStatus == 0) {
                $user->restricted_until = null;
            }

            $user->user_status = $this->itemStatus;
            $user->save();
            $this->editingStatus = null;

            $this->render();

            $this->dispatch('saveModal', status: 'success', position: 'top', message: 'Information updated successfully');
        }
    }




    public function userID($id)
    {
        $this->id = $id;
    }

    public function userDelete()
    {
        $user = User::findOrFail($this->id);
        $user->delete();

        $this->dispatch('saveModal', status: 'error', position: 'top', message: 'Delete user successfully');
    }

    public function editLoginDetails(int $id)
    {
        $users = User::where('id', $id)->first();

        if ($users) {
            $this->id = $users->id;
            $this->username = $users->username;
            $this->email = $users->email;

            $this->dispatch('editModal');
        }
    }

    public function saveLogindetails()
    {
        $user = User::findOrFail($this->id);

        // Validate the username and email
        $this->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'], // Make password optional
        ]);

        // Update user details
        $user->update([
            'username' => $this->username,
            'email' => $this->email,
            // Update password if provided, else keep the existing one
            'password' => empty($this->password) ? $user->password : Hash::make($this->password),
        ]);

        // Dispatch success message
        $this->dispatch('saveModal', status: 'success', position: 'top', message: 'Information updated successfully');
    }


    public function closeModal()
    {
        $this->dispatch('closeModal');
    }
}
