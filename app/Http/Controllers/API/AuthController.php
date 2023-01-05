<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\User;

class AuthController extends Controller
{
     public function register(Request $request)
    {
        // Rule Validasi 
        $rule_validasi = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ];

        // Custom Message
        $pesan_validasi = [
            "name.required"         => "Nama Harus di Isi !",

            "email.required"        => "e-Mail Harus di Isi !",
            "email.email"           => "Format e-Mail Tidak Sesuai !",
            "email.unique"          => "e-Mail Sudah di Gunakan !",

            "password.required"     => 'Password Harus di Isi !',
            "password.min"          => 'Password Minimal 6 Karakter !',

            "c_password.required"   => 'Konfirmasi Password Harus di Isi !',
            "c_password.same"       => 'Konfirmasi Password Tidak sama !',
        ];

        // Validasi
        $validator = Validator::make($request->all(), $rule_validasi, $pesan_validasi);

        // Jika Gagal Validasi
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Daftar !',
                'data'    => $validator->errors(),
            ], 401);
        }

        // Mapping Request
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        // Save To DB
        $user = User::create($input);

        // Create Token
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return response()->json([
            'success' => true,
            'message' => 'Register Berhasil !',
            'data'    => $success
        ], 201);
    }

     public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {


            $user = $request->user();

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil !',
                'token'   => $user->createToken('MyApp')->plainTextToken,
                'data'    => $user
            ], 201);

        } else {

            return response()->json([
                'success' => false,
                'message' => 'Login Gagal !',
                'data'    => ['error' => 'User / Password Tidak Sesuai !']
            ], 403);

        }
    }

    public function logout(Request $request)
    {
        $data = $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout Berhasil !',
            'data'    => $data
        ], 200);
    }
    
}
