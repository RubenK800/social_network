<?php

namespace App\Http\Controllers;

use App\Models\UsersAvatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class UsersAvatarsController
{
    public function index(){
//        $userId = Auth::id();
//        $avatar = Avatar::where('id',$userId)->first();
//        return view('user-profile.profile',['avatar'=>$avatar]);
    }

    public function store(Request $request)
    {
        $file = $request->file('img');
        $userId = Auth::id();
        $name = Str::random(40).'.jpg';
            $entry = UsersAvatar::where('user_id', $userId)->first();
            if ($entry === null) {
                // user doesn't exist
                $file->storeAs('avatars/'.'avatar-of-user' . $userId, $name);
                UsersAvatar::insert(['user_id' => $userId, 'user_avatar_name' => $name]);
            }else{
                //https://www.geeksforgeeks.org/deleting-all-files-from-a-folder-using-php/
                $folder_path = 'storage/avatars/avatar-of-user'.$userId;
                $fFiles = glob($folder_path . '/*');
                foreach ($fFiles as $fFile) {
                    if (is_file($fFile))
                        unlink($fFile);
                }
                $file->storeAs('avatars/'.'avatar-of-user' . $userId, $name);
                UsersAvatar::where('user_id',$userId)->update(['user_avatar_name'=>$name]);
            }
        $avatar = UsersAvatar::where('user_id',$userId)->first();
        return Redirect::route('user.profile.index')->with(['avatar' => $avatar]);
    }

    public function show(UsersAvatar $userAvatar){
        return view('user-profile.profile',['avatar'=>$userAvatar]);
    }
}
