<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class AdminController extends Controller
{
    public function index(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->usertype == 'user') {
                $rooms = Room::all(); // Fetch all rooms
                return view('hotel.index', compact('rooms'));
            } else if ($user->usertype == 'admin') {
                $bookedClientsCount = Booking::count();
                $vacantRoomsCount = Room::where('room_status', 'Vacant')->count();
                $bookedRoomsCount = Room::where('room_status', 'Booked')->count();

                $perPage = $request->get('per_page', 10); // Default to 10 entries per page
                $bookings = Booking::with('room')->paginate($perPage);

                return view('admin.index', compact('bookedClientsCount', 'vacantRoomsCount', 'bookedRoomsCount', 'bookings', 'perPage'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $details = [
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::to($request->email)->send(new ContactMail($details));

        return redirect()->back()->with('success', 'Email sent successfully.');
    }

    public function hotel()
    {
        $rooms = Room::all(); // Fetch all rooms
        return view('hotel.index', compact('rooms'));
    }

    public function booked_users(Request $request) {
        // Fetch statistics
        $bookedClientsCount = Booking::count();
        $vacantRoomsCount = Room::where('room_status', 'Vacant')->count();
        $bookedRoomsCount = Room::where('room_status', 'Booked')->count();

        // Fetch bookings with pagination
        $perPage = $request->get('per_page', 10); // Default to 10 entries per page
        $bookings = Booking::with('room')->paginate($perPage);

        // Pass data to the view
        return view('admin.booked_users', compact('bookedClientsCount', 'vacantRoomsCount', 'bookedRoomsCount', 'bookings', 'perPage'));
    }

    public function view_contacts() {
        $contacts = Contact::all(); // Fetch all contacts
        return view('admin.view_contacts', compact('contacts'));
    }

    public function approveBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->room->update(['room_status' => 'Booked']);
        return redirect()->back()->with('success', 'Booking approved successfully.');
    }

    public function rejectBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->room->update(['room_status' => 'Rejected']);
        return redirect()->back()->with('success', 'Booking rejected successfully.');
    }

    public function destroyBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Booking deleted successfully.');
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
            'room_status' => 'required|string|in:Vacant,Booked',
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
