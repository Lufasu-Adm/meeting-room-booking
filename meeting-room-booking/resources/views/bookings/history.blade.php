<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
            Riwayat Booking Ruang Rapat
        </h2>
    </x-slot>

    <div class="py-6 px-6 max-w-3xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded dark:bg-green-200 dark:text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($bookings as $booking)
            <div class="p-4 mb-4 bg-white dark:bg-gray-900 text-gray-900 dark:text-white rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <p><strong>Ruang:</strong> {{ optional($booking->room)->name ?? '-' }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}</p>
                <p><strong>Waktu:</strong>
                    {{ $booking->start_time ? substr($booking->start_time, 0, 5) : '-' }}
                    -
                    {{ $booking->end_time ? substr($booking->end_time, 0, 5) : '-' }}
                </p>
                <p><strong>Status:</strong>
                    @if ($booking->status === 'approved')
                        <span class="font-semibold dark:text-white text-green-600">Disetujui</span>
                    @elseif ($booking->status === 'rejected')
                        <span class="font-semibold text-red-600">Ditolak</span>
                    @else
                        <span class="font-semibold dark:text-white text-yellow-600">Menunggu</span>
                    @endif
                </p>
            </div>
        @empty
            <div class="text-gray-500 dark:text-white">Belum ada riwayat booking.</div>
        @endforelse
    </div>
</x-app-layout>