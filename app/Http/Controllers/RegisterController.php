<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Bouncer;
use App\Enums\RolesEnum;


class RegisterController extends Controller
{

    public function create()
    {
        return view('register');     
    }

    public function register()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:255|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'name' => $validator->errors()->first('name'),
                        'email' => $validator->errors()->first('email'),
                        'password' => $validator->errors()->first('password'),
                    ]);
        }


        $user = User::firstOrCreate([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password'))
        ]);

        if ($user)
        {
            Bouncer::assign(RolesEnum::USER->value)->to($user);
            Auth::login($user);
        }

        if (Auth::check())
        {
            return response()->json([
                "redirect" => url("books")
            ]);
        }

        throw new NotFoundHttpException('Authentication error');
        
    }
}
