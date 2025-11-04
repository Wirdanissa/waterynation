<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LandingController extends Controller
{

    // User
    public function index()
    {
        return view('pages.guest.home.index');
    }

    public function profile()
    {
        return view('pages.guest.tentang.profile');
    }

    // Admin
    public function admin(){
        return view('pages.admin.dashboard.index');
    }
    public function adminUser()
    {
        $users = User::where('role', 'user')
            ->orderBy('name', 'asc')->paginate(10);
        return view('pages.admin.user.index', compact('users'));
    }

    public function adminDeleteUser(string $id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
    }
    // public function adminEditUser(string $id)
    // {
    //     $users = User::findOrFail($id);
    //     return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
    // }


}
