<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
      $validated = $request->validate([
        'name' => ['required', 'string', 'max:50'],
        'email' => ['required', 'string', 'email','max:50', 'unique:users'],
        'password' => ['required', 'string', 'min:7','max:50', 'confirmed'],
        'agreement' => ['accepted'],
      ]);
      
      
    $user = User::query()->create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);
      
        Auth::login($user);
        return redirect()->route('user');    
    }
}
 