<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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
        return view('hotel.index');
    }
}
