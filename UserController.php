<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->pending(20);
        return view('users.index', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $valideted = $request->validate([
            'name' => 'required|max:50',
            'umail' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $valideted['name'],
            'umail' => $valideted['umail'],
            'password' => Hash::make($valideted['password'])
        ]);

        return redirect('/users');
    }
}
