<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function admin(){
        return view('pages.admin.dashboard.index');
    }

    public function index()
    {
        return view('pages.guest.home.index');
    }

    public function adminUser()
    {
        $users = User::where('role', 'user')
            ->orderBy('name', 'asc')->paginate(10);
        return view('pages.admin.user.index', compact('users'));
    }
}
