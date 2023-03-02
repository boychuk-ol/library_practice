<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function myAccount()
    {
        return view('myAccount', ['user' => User::where('id', Auth::user()->id)->first()]);
    }
}
