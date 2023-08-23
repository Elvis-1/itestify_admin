<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Laravel\Sanctum\HasApiTokens;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
          //  'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'user_name' => $request->name ?? 'Your name',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // $user = new User;
        // $user->name = $request->name ?? 'Your name';
        // $user->email = $request->email;
        // $user->password = $request->password;
        // $user->save();
        $token = $user->createToken('itestify')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token'=>$token,

        ],200);

    }
}
