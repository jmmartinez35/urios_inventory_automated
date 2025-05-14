<?php

namespace App\Livewire\Frontend;

use App\Models\UserDetails;
use Livewire\Component;

class NavbarHello extends Component
{
    public function render()
    {
        $user = UserDetails::where('users_id',  auth()->user()->id)->first();
        $name_str = "";
        $pos_str = "";
        if (!empty($user->firstname)) {
            $name = ucfirst(strtolower($user->firstname));
            $pos_str = ucfirst(strtolower($user->position));

            // if (!empty($user->middlename)) {
            //     $name .= " " . ucfirst($user->middlename);
            // }
            // $name .= " " . ucfirst($user->lastname);
            $name_str =  $name;
        }
        return view('livewire.frontend.navbar-hello', ['name_str' => $name_str, 'pos_str' => $pos_str]);
    }
}
