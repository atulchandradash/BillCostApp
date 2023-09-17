<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{

    public function registration(Request $request)
    {
        $userData = $request->validate([

            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        $userData['password'] = Hash::make($request->input('password'));

        $data = User::create($userData);

        if (!$data) {

            return die;
        }

        return redirect()->route('auth')->with('success', "Registration Complete Now Please Login!!");


    }

    public function login(Request $request)
    {
        $userData = $request->validate([

            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($userData)) {
            return redirect()->route('welcome');

        } else {
            return redirect()->back()->with('error', "Login Details Are Not Correct");
        }


    }


    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth');
    }
}