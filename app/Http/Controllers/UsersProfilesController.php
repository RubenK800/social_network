<?php

namespace App\Http\Controllers;

use App\Models\UsersAvatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersProfilesController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $avatar = UsersAvatar::where('user_id',$userId)->first();
        //dd($avatar);
        return http_response_code(201);//view('user-profile.profile',['avatar'=>$avatar]);
    }
}
