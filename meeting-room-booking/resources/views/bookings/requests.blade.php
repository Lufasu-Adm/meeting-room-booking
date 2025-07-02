<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Permintaan Booking Ruang Rapat
        </h2>
    </x-slot>

    <div class="py-6 px-6 max-w-5xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        @forelse ($bookings as $booking)
            <div class="p-4 mb-4 bg-white border border-gray-200 rounded shadow">
                <p><strong>Pengguna:</strong> {{ $booking->user->name }}</p>
                <p><strong>Ruang:</strong> {{ $booking->room->name }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}</p>
                <p><strong>Waktu:</strong> {{ substr($booking->start_time, 0, 5) }} - {{ substr($booking->end_time, 0, 5) }}</p>
                <p><strong>Status:</strong>
                    <span class="text-yellow-600 font-semibold">Menunggu</span>
                </p>

                <div class="mt-3 flex gap-2">
                    <form method="POST" action="{{ route('admin.bookings.approve', $booking->id) }}">
                        @csrf
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                            Setujui
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.bookings.reject', $booking->id) }}">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                            Tolak
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Tidak ada permintaan booking yang menunggu persetujuan.</p>
        @endforelse
    </div>
</x-app-layout>