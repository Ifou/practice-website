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
                $rooms = Room::all(); // Fetch all rooms
                return view('hotel.index', compact('rooms'));
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
            'room_status' => 'required|string|in:Vacant,Waiting,Booked',
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

}
