<?php


namespace App\Http\Controllers;


class UsersWallsController
{
    public function show($id){
        return view('user-profile.user-wall');
    }
}
