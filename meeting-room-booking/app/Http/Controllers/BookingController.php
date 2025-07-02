<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Tampilkan form pemilihan ruang rapat
    public function index()
    {
        $rooms = Room::all();
        return view('bookings.index', compact('rooms'));
    }

    // Simpan booking baru dengan validasi konflik
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // Cek konflik booking
        $conflict = Booking::where('room_id', $request->room_id)
            ->where('booking_date', $request->booking_date)
            ->where('status', '!=', 'rejected')
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                      });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Room not available for the selected time.');
        }

        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'pending', // akan divalidasi admin
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diajukan!');
    }

    // Riwayat booking user
    public function history()
    {
        $bookings = Booking::with('room')
            ->where('user_id', Auth::id())
            ->orderByDesc('booking_date')
            ->get();

        return view('bookings.history', compact('bookings'));
    }

    // List permintaan booking untuk admin
    public function requests()
    {
        $bookings = Booking::with(['user', 'room'])
            ->where('status', 'pending')
            ->orderBy('booking_date')
            ->get();

        return view('admin.bookings.requests', compact('bookings'));
    }

    // Setujui booking (admin)
    public function approve(Booking $booking)
    {
        $booking->update(['status' => 'approved']);
        return back()->with('success', 'Booking disetujui.');
    }

    // Tolak booking (admin)
    public function reject(Booking $booking)
    {
        $booking->update(['status' => 'rejected']);
        return back()->with('error', 'Booking ditolak.');
    }
}