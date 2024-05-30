<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class LoginController extends Controller
{
    // Method untuk menangani proses autentikasi login
    public function check(Request $request)
    {
        // Validasi data yang diterima dari request
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Mencoba melakukan autentikasi menggunakan metode attempt() dari Auth
        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil, kirim respons JSON dengan status true, pesan sukses, dan role pengguna
            return response()->json([
                'status' => true,
                'message' => "Success",
                'role' => Auth::user()->role,
            ]);
        }

        // Jika autentikasi gagal, kirim respons JSON dengan status false dan pesan kegagalan
        return response()->json([
            'status' => false,
            'message' => "Fail"
        ]);
    }

    public function getuser()
    {
        // Ambil data pengguna
        $users = Auth::user();

        return response()->json([
            'status' => true,
            'message' => "Success",
            'data' => $users
        ]);
    }
}
