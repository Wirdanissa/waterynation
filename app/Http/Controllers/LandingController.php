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
    /**
     * Tampilan Landing Page (Beranda) - Bagian User
     */
    public function index()
    {
        $publikasis = Publikasi::where('status_publikasi', 'published')
            ->latest()
            ->take(12)
            ->get();

        $volunteers = Volunteer::where('status_publikasi', 'published')
            ->latest()
            ->take(3)
            ->get();

        $donasis = Donasi::where('status', 'success')
            ->sum('total_donasi');

        $latest_donations = Donasi::where('status', 'success')
            ->latest()
            ->take(10)
            ->get();

        $relawan = VolunterRegister::where('status', 'accepted')
            ->count();

        $aktivitas = Programs::where('status_publikasi', 'published')
            ->count();

        return view('pages.guest.home.index', compact(
            'publikasis', 
            'volunteers', 
            'donasis', 
            'relawan', 
            'aktivitas',
            'latest_donations'
        ));
    }

    /**
     * DASHBOARD ADMIN - Sekarang sudah Dinamis
     */
    public function admin()
    {
        // Mengambil data real dari database untuk statistik
        $totalDonasi = Donasi::where('status', 'success')->sum('total_donasi');
        $countProgram = Programs::count();
        $countVolunteerReg = VolunterRegister::count();
        $countPublikasi = Publikasi::count();

        // Mengirim data ke view agar angka di dashboard terupdate
        return view('pages.admin.dashboard.index', compact(
            'totalDonasi',
            'countProgram',
            'countVolunteerReg',
            'countPublikasi'
        ));
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

    /**
     * MANAJEMEN USER ADMIN
     */
    public function adminUser()
    {
        $users = User::where('role', 'user')
            ->orderBy('name', 'asc')
            ->paginate(10);
        return view('pages.admin.user.index', compact('users'));
    }

    public function adminEditUser(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.user.edit', compact('user'));
    }

    public function adminDeleteUser(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
    }
}