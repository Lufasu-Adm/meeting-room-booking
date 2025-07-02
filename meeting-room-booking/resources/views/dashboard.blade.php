<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Halo, {{ Auth::user()->name }} 👋</h1>
                <p class="text-gray-700 mb-6">Selamat datang di Sistem Peminjaman Ruang Rapat.</p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('bookings.index') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-center">
                        Booking Ruang Rapat
                    </a>

                    <a href="{{ route('bookings.history') }}"
                       class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 text-center">
                        Riwayat Booking
                    </a>

                    @can('isAdmin')
                        <a href="{{ route('admin.bookings.requests') }}"
                           class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-center">
                            Validasi Booking (Admin)
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>