<?php

namespace App\Http\Controllers;

use App\Models\VolunterRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VolunterRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $volunteers = VolunterRegister::with('volunter')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.admin.volunteer_regis.index', compact('volunteers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'volunter_id' => 'required|exists:volunteers,id',
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'required|string|min:10|max:15',
            'instagram'   => 'nullable|string|max:255',
            'linkedin'    => 'nullable|string|max:255',
            'position'    => 'required|string|max:255',
            // PERBAIKAN: Format PDF dan Max 10MB (10240 KB)
            'image'       => 'required|mimes:pdf|max:10240',
        ], [
            'image.mimes' => 'Dokumen yang diunggah harus berformat PDF.',
            'image.max'   => 'Ukuran dokumen maksimal adalah 10MB.',
            'phone.min'   => 'Nomor telepon minimal 10 digit.',
        ]);

        // Cek Double Registration (User tidak boleh daftar di lowongan yang sama dua kali)
        $exists = VolunterRegister::where('volunter_id', $request->volunter_id)
                                  ->where('email', $request->email)
                                  ->exists();
        
        if ($exists) {
            return redirect()->back()->with('error', 'Anda sudah mendaftar untuk posisi ini sebelumnya.');
        }

        if ($request->hasFile('image')) {
            // Folder penyimpanan PDF
            $imagePath = $request->file('image')->store('volunteer-registrations/cv', 'public');
            $validated['image'] = $imagePath;
        }

        $validated['slug'] = Str::slug($validated['name'] . '-' . Str::random(5));
        $validated['status'] = 'Pending';

        VolunterRegister::create($validated);

        return redirect()->back()->with('success', 'Pendaftaran Anda berhasil dikirim! Kami akan menghubungi Anda melalui WhatsApp/Email.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $volunteer = VolunterRegister::with('volunter')->findOrFail($id);

        $status = [
            'accepted' => 'Accepted',
            'pending' => 'Pending',
        ];

        return view('pages.admin.volunteer_regis.edit', compact('volunteer', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $volunteer = VolunterRegister::findOrFail($id);

        $validatedData = $request->validate([
            'status' => 'required|in:accepted,pending',
        ]);

        $volunteer->update($validatedData);

        return redirect()->route('admin.volunteer-registrasi.index')->with('success', 'Status pendaftar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $volunteer = VolunterRegister::findOrFail($id);
        
        if ($volunteer->image) {
            Storage::disk('public')->delete($volunteer->image);
        }
        
        $volunteer->delete();

        return redirect()->back()->with('success', 'Data pendaftar berhasil dihapus.');
    }
}