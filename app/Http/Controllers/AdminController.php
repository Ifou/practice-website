<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->usertype == 'user') {
                return view('dashboard');
            } else if ($user->usertype == 'admin') {
                return view('admin.index');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function adminIndex() {
        return view('admin.index');
    }
}
