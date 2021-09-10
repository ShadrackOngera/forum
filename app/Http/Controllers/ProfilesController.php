<?php

namespace App\Http\Controllers;

use App\User;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
//        $user = User::find($user);
        return view('profiles.show', [
            'profileUser' => $user
        ]);
    }
}
