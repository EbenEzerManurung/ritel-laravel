<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nama_user' => 'required',
            'password' => 'required',
        ]);

        try {
            // Panggil API Golang
            $response = Http::post('http://localhost:8080/api/login', [
                'nama_user' => $request->nama_user,
                'password' => $request->password,
            ]);

            if ($response->successful() && $response->json('user')) {
                $user = $response->json('user');
                
                // Simpan data ke session
                Session::put('user_id', $user['id_user']);
                Session::put('user_name', $user['nama_user']);
                Session::put('user_role', $user['role_user']);
                Session::put('token', 'dummy-token');

                return redirect()->route('dashboard');
            }

            return back()->with('error', 'Login gagal! Periksa username dan password.');
        } catch (\Exception $e) {
            return back()->with('error', 'Koneksi ke server gagal! Pastikan backend Golang berjalan.');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}