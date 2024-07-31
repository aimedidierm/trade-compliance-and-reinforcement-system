<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)->first();
        if ($user != null) {
            $passwordMatch = Hash::check($password, $user->password);
            if ($passwordMatch) {

                Auth::login($user);
                if ($user->role == UserRole::SELLER->value) {
                    return redirect("/seller");
                } elseif ($user->role == UserRole::EXPORTER->value) {
                    return redirect("/exporter");
                } elseif ($user->role == UserRole::MINICOM->value) {
                    return redirect("/minicom");
                } else {
                    return redirect(route('login'))->withErrors(['msg' => 'Invalid user role']);
                }
            } else {
                return redirect(route('login'))->withErrors(['msg' => 'Incorect password']);
            }
        } else {
            return redirect(route('login'))->withErrors(['msg' => 'Incorect email and password']);
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/');
        } else {
            return back();
        }
    }
}
