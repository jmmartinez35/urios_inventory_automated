<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function pending()
    {

        return view('admin.users.pending');
    }

    public function management()
    {

        return view('admin.users.management');
    }

    public function myaccount()
    {

        return view('admin.users.myaccount');
    }
}
