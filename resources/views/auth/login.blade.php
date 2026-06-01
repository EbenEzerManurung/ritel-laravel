@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-8">

        <!-- Logo dan Title -->
        <div class="text-center mb-8">

            <div class="flex justify-center mb-4">
                <img
                    src="{{ asset('favicon.png') }}"
                    alt="Logo Ritel Laravel"
                    class="w-20 h-20 object-contain"
                >
            </div>

            <h1 class="text-3xl font-bold text-gray-800">
                Ritel Laravel
            </h1>


        </div>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                <input type="text" name="nama_user" class="input-field" placeholder="Masukkan username" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" class="input-field" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="w-full btn-primary">Login</button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            <p class="font-semibold">Demo Account:</p>
            <p>Admin: Admin User / password123</p>
            <p>Kasir: Kasir User / password123</p>
        </div>
    </div>
</div>
@endsection
