<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    # Membuat functions untuk fitur register
    public function register(Request $request) {
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
        ];

        $user = User::create($input);

        $data = [
            'pesan' => 'User telah berhasil di buat'
        ];
        return response()->json($data, 200);
    }

    # Membuat functions untuk fitur login
    public function login(Request $request){
        # Membuat functions untuk fitur login
        $input = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        # Mengambil data login dari Databases
        $user = User::where('email', $request->email)->first();

        # Jika user ada dan membandingkan user dengan databases
        $isLoginSuccessfully = (
            $input['email'] == $user->email
            && 
            Hash::check($input['password'], $user->password)
        );

        if ($isLoginSuccessfully){
            # Membuat token JWT
            $token = $user->createToken('authToken');

            $data = [
                'message' => 'Login Berhasil !',
                'token' => $token->plainTextToken
            ];

            # Mengembalikan responses JSON
            return response()->json($data, 200);
        } else {
            $data = [
               'message' => 'Login Gagal!'
            ];
            return response()->json($data, 401);
        }

       
    }
}
