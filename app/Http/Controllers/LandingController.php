<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Organisasi;
use App\Models\Programs;
use App\Models\Publikasi;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\VolunterRegister;
use Illuminate\Http\Request;

class LandingController extends Controller
{

    // User
    public function index()
    {
        $publikasis = Publikasi::where('status_publikasi', 'published')
            ->inRandomOrder()
            ->take(12)
            ->get();

        $volunteers = Volunteer::where('status_publikasi', 'published')
            ->inRandomOrder()
            ->take(3)
            ->get();

        $donasis = Donasi::where('status', 'accepted')
            ->sum('total_donasi');

        $relawan = VolunterRegister::where('status', 'accepted')
            ->count();

        $aktivitas = Programs::where('status_publikasi', 'published')
            ->count();

        return view('pages.guest.home.index', compact('publikasis', 'volunteers', 'donasis', 'relawan', 'aktivitas'));
    }

    public function profile()
    {
        $tentang = Organisasi::select('core_values', 'focus_areas', 'about')->first();
        return view('pages.guest.tentang.profile', compact('tentang'));
    }

    public function landingVisiMisi()
    {
        $visiMisi = Organisasi::select('visi', 'misi')->first();
        return view('pages.guest.tentang.visi-misi', compact('visiMisi'));
    }

    public function landingTim()
    {
        return view('pages.guest.tentang.tim');
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
}
