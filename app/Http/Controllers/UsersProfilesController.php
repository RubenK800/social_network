<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersProfilesController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $avatar = Avatar::where('user_id',$userId)->first();
        //dd($avatar);
        return view('user-profile.profile',['avatar'=>$avatar]);
    }
}
