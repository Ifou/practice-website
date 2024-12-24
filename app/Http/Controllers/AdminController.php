<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;

class AdminController extends Controller
{
    public function index() {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->usertype == 'user') {
                return view('hotel.index');
            } else if ($user->usertype == 'admin') {
                return view('admin.index');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('login');
        }
    }
    public function hotel() {
        $rooms = Room::all(); // Fetch all rooms
        return view('hotel.index', compact('rooms'));
    }

    public function create_room() {
        return view('admin.create_room');
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_title' => 'required|string|max:255',
            'room_description' => 'required|string',
            'room_image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'room_price' => 'required|string|max:255',
            'room_type' => 'required|string|max:255',
            'room_status' => 'required|string|max:255',
            'room_capacity' => 'required|string|max:255',
            'room_wifi' => 'required|string|max:255',
        ]);

        $imageName = time().'.'.$request->room_image->extension();
        $request->room_image->move(public_path('images'), $imageName);

        Room::create([
            'room_title' => htmlspecialchars($request->room_title),
            'room_description' => htmlspecialchars($request->room_description),
            'room_image' => $imageName,
            'room_price' => htmlspecialchars($request->room_price),
            'room_type' => htmlspecialchars($request->room_type),
            'room_status' => htmlspecialchars($request->room_status),
            'room_capacity' => htmlspecialchars($request->room_capacity),
            'room_wifi' => htmlspecialchars($request->room_wifi),
        ]);

        return redirect()->back()->with('success', 'Room added successfully.')->with('image', $imageName);
    }

    public function view_room() {
        $rooms = Room::paginate(10); // Display 10 rooms per page
        return view('admin.view_room', compact('rooms'));
    }

    public function destroy($id)
    {
        $user = Auth::user();

        // Check if the user is an admin
        if ($user->usertype !== 'admin') {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->back()->with('success', 'Room deleted successfully.');
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.edit_room', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'room_title' => 'required|string|max:255',
            'room_description' => 'required|string',
            'room_image' => 'image|mimes:jpeg,jpg,png|max:2048',
            'room_price' => 'required|string|max:255',
            'room_type' => 'required|string|max:255',
            'room_status' => 'required|string|max:255',
            'room_capacity' => 'required|string|max:255',
            'room_wifi' => 'required|string|max:255',
        ]);

        $room = Room::findOrFail($id);

        if ($request->hasFile('room_image')) {
            $imageName = time().'.'.$request->room_image->extension();
            $request->room_image->move(public_path('images'), $imageName);
            $room->room_image = $imageName;
        }

        $room->update([
            'room_title' => $request->room_title,
            'room_description' => $request->room_description,
            'room_price' => $request->room_price,
            'room_type' => $request->room_type,
            'room_status' => $request->room_status,
            'room_capacity' => $request->room_capacity,
            'room_wifi' => $request->room_wifi,
        ]);

        return redirect()->route('view')->with('success', 'Room updated successfully.');
    }

    public function getRoomDetails($id)
    {
        $room = Room::find($id);
        return response()->json($room);
    }

    public function book() {
        $rooms = Room::all(); // Fetch all created rooms
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
