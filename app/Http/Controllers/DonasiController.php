<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Organisasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function donasiUser()
    {
        $organisasi = Organisasi::first();
        return view('pages.guest.donasi.index', compact('organisasi'));
    }

    public function index()
    {
        return view('pages.admin.donasi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'tanggal_donasi'  => 'required|date',
            'total_donasi'    => 'required|numeric|min:1000',
            'bukti_transfer'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan'      => 'nullable|string|max:255',
            'show_name' => 'nullable|boolean',
        ],[
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'tanggal_donasi.required' => 'Tanggal wajib diisi.',
            'total_donasi.required' => 'Jumlah donasi wajib diisi.',
            'bukti_transfer.required' => 'Upload bukti transfer wajib.',
        ]);

        // Simpan bukti transfer
        $validated['bukti_transfer'] = $request->file('bukti_transfer')->store('donasi_bukti', 'public');
        $validated['status'] = 'pending';
        $validated['show_name'] = $request->has('show_name');

        Donasi::create($validated);

        return redirect()->route('donasi')
                         ->with('success', 'Donasi berhasil dikirim. Terima kasih!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donasi $donasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donasi $donasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donasi $donasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donasi $donasi)
    {
        //
    }
}
