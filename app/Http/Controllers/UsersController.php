<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
//        $users = User::paginate(2);
//        return view('users-list', ['users'=>$users]);
        return response()->json([
            'userId' => Auth::id(),
        ]);
    }
}
