<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersProfilesController extends Controller
{
    public function show()
    {
        return view('user-profile.profile');
    }
}
