<?php

namespace App\Http\Controllers;

use App\Models\UsersAvatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UsersProfilesController extends Controller
{
    public function index()
    {
//        $userId = Auth::id();
//        $avatar = UsersAvatar::where('user_id',$userId)->first();
        return response()->json(Auth::user(), 201);//Auth::user();/*Response::json([
           // 'hello' => 'ohhh'
        //], 201);*///http_response_code(201);//view('user-profile.profile',['avatar'=>$avatar]);
    }
}
