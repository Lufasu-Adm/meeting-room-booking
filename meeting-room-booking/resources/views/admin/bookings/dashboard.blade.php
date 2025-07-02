@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 lg:p-8">
    <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">Total Permintaan</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $pendingCount }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">Disetujui</h2>
            <p class="text-3xl font-bold text-green-600">{{ $approvedCount }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">Ditolak</h2>
            <p class="text-3xl font-bold text-red-600">{{ $rejectedCount }}</p>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('admin.bookings.requests') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
            Lihat Permintaan Booking
        </a>
    </div>
</div>
@endsection