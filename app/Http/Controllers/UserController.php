<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getRoomDetails($id)
    {
        $room = Room::find($id);
        return response()->json($room);
    }

    public function book() {
        $bookedRoomIds = Booking::pluck('room_id')->toArray();
        $rooms = Room::whereNotIn('id', $bookedRoomIds)->get(); // Fetch all available rooms
        return view('hotel.book', compact('rooms'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'full_name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Booking::create([
            'room_id' => $request->room_id,
            'full_name' => htmlspecialchars($request->full_name),
            'number' => htmlspecialchars($request->number),
            'email' => htmlspecialchars($request->email),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->back()->with('success', 'Booking successful.');
    }
}
