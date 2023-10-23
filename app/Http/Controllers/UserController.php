<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:5', 'max:20'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:25']
        ]);

        $incomingFields['password'] = Hash::make($incomingFields['password']);
        User::create($incomingFields);

        return 'Hello from our controller';
    }
}
