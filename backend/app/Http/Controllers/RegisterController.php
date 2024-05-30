<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Method untuk menangani proses registrasi
    public function store(Request $request)
    {
        // Mengambil semua data dari request
        $input = $request->all();

        // Membuat sebuah user baru dalam database
        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'] ?? 'user', // Set the role based on the received value or default to 'user'
        ]);

        // Memberikan respons JSON jika registrasi berhasil
        return response()->json([
            'status' => true,
            'message' => "Registration Success"
        ]);
    }
}
