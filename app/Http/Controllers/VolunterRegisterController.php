<?php

namespace App\Http\Controllers;

use App\Models\VolunterRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VolunterRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'volunter_id' => 'required|exists:volunteers,id',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:volunter_registers,email,NULL,id,volunter_id,' . $request->volunter_id,
            'phone'      => 'required|string|min:11|max:15',
            'instagram'  => 'nullable|string|max:255',
            'linkedin'   => 'nullable|string|max:255',
            'position'   => 'required|string|max:255',
            'image'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'volunter_id.required' => 'ID Volunteer wajib diisi.',
            'volunter_id.exists' => 'ID Volunteer tidak ditemukan.',
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.max' => 'Email maksimal 255 karakter.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.max' => 'Nomor telepon maksimal 15 karakter.',
            'phone.min' => 'Nomor telepon minimal 11 karakter.',
            'instagram.string' => 'Instagram harus berupa teks.',
            'instagram.max' => 'Instagram maksimal 255 karakter.',
            'linkedin.string' => 'Linkedin harus berupa teks.',
            'linkedin.max' => 'Linkedin maksimal 255 karakter.',
            'position.required' => 'Posisi wajib diisi.',
            'position.string' => 'Posisi harus berupa teks.',
            'position.max' => 'Posisi maksimal 255 karakter.',
            'image.required' => 'Gambar wajib diisi.',
            'image.image' => 'Gambar harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('volunteer-registrations', 'public');
            $validated['image'] = $imagePath;
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['status'] = 'Pending';

        VolunterRegister::create($validated);

        return redirect()->back()->with('success', 'Pendaftaran berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(VolunterRegister $volunterRegister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VolunterRegister $volunterRegister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VolunterRegister $volunterRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VolunterRegister $volunterRegister)
    {
        //
    }
}
