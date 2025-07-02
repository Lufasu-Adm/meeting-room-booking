<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
            Validasi Permintaan Booking
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        @forelse ($bookings as $booking)
            <div class="bg-white dark:bg-gray-800 shadow rounded p-4 mb-4 border border-gray-200 dark:border-gray-700">
                <p class="text-gray-800 dark:text-white"><strong>User:</strong> {{ optional($booking->user)->name ?? '-' }}</p>
                <p class="text-gray-800 dark:text-white"><strong>Ruang:</strong> {{ optional($booking->room)->name ?? '-' }}</p>
                <p class="text-gray-800 dark:text-white"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}</p>
                <p class="text-gray-800 dark:text-white"><strong>Jam:</strong> {{ substr($booking->start_time, 0, 5) }} - {{ substr($booking->end_time, 0, 5) }}</p>
                <p class="text-gray-800 dark:text-white"><strong>Status:</strong> 
                    <span class="text-yellow-500 font-semibold">{{ ucfirst($booking->status) }}</span>
                </p>

                <div class="mt-3 flex gap-2">
                    <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded">
                            Setujui
                        </button>
                    </form>

                    <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded">
                            Tolak
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-400">Tidak ada permintaan booking yang perlu divalidasi.</p>
        @endforelse
    </div>
</x-app-layout>