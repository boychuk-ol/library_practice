<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class LoginController extends Controller
{
    public function create()
    {
        return view('login');     
    }

    public function login()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|exists:users,name',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'name' => $validator->errors()->first('name'),
                        'password' => $validator->errors()->first('password'),
                    ]);
        }
       
        $user = User::where('name', request()->name)->first();

        if (!$user || !Hash::check(request()->password, $user->password))
        {
            return response()->json([
                'password' => 'Password mismatch',
            ]);
        }

        Auth::login($user);

        if(Auth::check())
        {
            return response()->json([
                'redirect' => url('books'),
            ]);
        }

        throw new NotFoundHttpException('Authentication error');

    }


    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
 
        request()->session()->regenerateToken();

        if (!Auth::check())
        {
            return redirect('books');
        }

        abort(404);
    }
}
