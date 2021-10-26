<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UsersAvatarsController
{
    public function index(){
//        $userId = Auth::id();
//        $avatar = Avatar::where('id',$userId)->first();
//        return view('user-profile.profile',['avatar'=>$avatar]);
    }

    public function store(Request $request)
    {
        $files = $request->file('img');
        foreach ($files as $file) {
            $userId = Auth::id();
            $file->storeAs('avatars', 'avatar-of-user' . $userId . '.jpg');
            $directory = asset('storage/'.'avatars/avatar-of-user' . $userId . '.jpg');
            $entry = Avatar::where('user_id', $userId)->first();
            if ($entry === null) {
                // user doesn't exist
                Avatar::insert(['user_id' => $userId, 'user_avatar_directory' => $directory]);
            }
        }
        $userId = Auth::id();
        $avatar = Avatar::where('user_id',$userId)->first();
        return /*view('user-profile.profile',['avatar'=>$avatar])*/ Redirect::route('user.profile.index')->with(['avatar' => $avatar]);
    }

    public function show($id){
        $userId = $id;
        $avatar = Avatar::where('id',$userId)->first();
        return view('user-profile.profile',['avatar'=>$avatar]);
    }
}
