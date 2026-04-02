<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. FUNGSI REGISTER
    public function register(Request $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // default sebagai user
        ]);

        return response()->json(['message' => 'User berhasil dibuat'], 201);
    }

    // 2. FUNGSI LOGIN
    public function login(Request $request) {
        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada dan passwordnya benar
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Email atau Password Salah'], 401);
        }

        // Buat TOKEN (Kunci akses untuk Flutter)
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login sukses!',
            'access_token' => $token,
            'role' => $user->role, // Kasih tau Flutter dia admin atau user
        ]);
    }

    // 3. FUNGSI LOGOUT
    public function logout(Request $request) {
        // Hapus token yang sedang digunakan
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Berhasil Logout']);
    }
}
