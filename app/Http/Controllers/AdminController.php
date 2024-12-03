<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addInstructor(User $user)
    {
        $user->role_id = 2;
        $user->save();
        return $user;
    }

    public function roleReset(User $user)
    {
        $user->role_id = 3;
        $user->save();
        return $user;
    }
}
