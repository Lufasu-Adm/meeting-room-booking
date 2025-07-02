<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Sistem Peminjaman Ruang Rapat') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-center items-center">
    <h1 class="text-5xl font-bold mb-6 text-center text-gray-800">
        Selamat Datang di <br />
        <span class="text-blue-600">{{ config('app.name', 'Sistem Peminjaman Ruang Rapat') }}</span>
    </h1>
    <p class="mb-8 text-lg text-gray-700 text-center max-w-md">
        Sistem peminjaman ruang rapat yang memudahkan pengelolaan dan reservasi ruang rapat secara online.
    </p>

    @if (Route::has('login'))
    <div class="space-x-4">
        @auth
        <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Dashboard
        </a>
        @else
        <a href="{{ route('login') }}" class="px-6 py-3 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Login
        </a>
        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
            Register
        </a>
        @endif
        @endauth
    </div>
    @endif
</body>
</html>