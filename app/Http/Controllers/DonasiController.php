<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonasiController extends Controller
{
    /**
     * Tampilan Halaman Donasi untuk User (Guest/User)
     */
    public function donasiUser()
    {
        $organisasi = Organisasi::first();

        // Ambil donasi terverifikasi untuk list publik
        $donaturVerified = Donasi::where('status', 'success')
            ->orderBy('tanggal_donasi', 'desc')
            ->get();

        // Ambil donasi pending & ditolak khusus milik user login
        $myPendingDonations = [];
        if (Auth::check()) {
            $myPendingDonations = Donasi::where('email', Auth::user()->email)
                ->whereIn('status', ['pending', 'rejected'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('pages.guest.donasi.index', compact('organisasi', 'donaturVerified', 'myPendingDonations'));
    }

    /**
     * Dashboard Manajemen Donasi untuk Admin (Lengkap dengan Statistik & Filter)
     */
    public function index(Request $request)
    {
        // 1. Logika Filter Bulan
        $selectedMonth = $request->get('month', date('Y-m')); // Default ke bulan berjalan (YYYY-MM)

        // 2. Hitung Statistik (Hanya untuk yang statusnya 'success')
        $statsQuery = Donasi::where('status', 'success')
            ->where(DB::raw("DATE_FORMAT(tanggal_donasi, '%Y-%m')"), $selectedMonth);

        $totalDonatur = $statsQuery->count();
        $totalDana = $statsQuery->sum('total_donasi');

        // 3. Ambil List Data Donasi untuk Table (Semua status, difilter bulan jika ada)
        $donations = Donasi::where(DB::raw("DATE_FORMAT(tanggal_donasi, '%Y-%m')"), $selectedMonth)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.donasi.index', compact(
            'donations', 
            'totalDonatur', 
            'totalDana', 
            'selectedMonth'
        ));
    }

    /**
     * Simpan Donasi Baru (User Side)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'tanggal_donasi' => 'required|date',
            'total_donasi'   => 'required|numeric|min:1000',
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan'     => 'nullable|string|max:255',
            'show_name'      => 'nullable|boolean',
        ]);

        if ($request->hasFile('bukti_transfer')) {
            $validated['bukti_transfer'] = $request->file('bukti_transfer')->store('donasi_bukti', 'public');
        }

        $validated['status']    = 'pending';
        $validated['show_name'] = $request->has('show_name') ? true : false;

        Donasi::create($validated);

        return redirect()->route('donasi')->with('success', 'Terima kasih! Donasi Anda sedang menunggu verifikasi admin.');
    }

    /**
     * Verifikasi Donasi (Admin Side)
     */
    public function verify($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update(['status' => 'success']);
        return redirect()->back()->with('success', 'Donasi berhasil diverifikasi!');
    }

    /**
     * Tolak Donasi (Admin Side)
     */
    public function reject($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update(['status' => 'rejected']);
        return redirect()->back()->with('error', 'Donasi telah ditolak.');
    }

    /**
     * Hapus Data Donasi
     */
    public function destroy($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->delete();
        return redirect()->back()->with('success', 'Data donasi berhasil dihapus.');
    }
}