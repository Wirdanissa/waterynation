<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $organisasis = Organisasi::all();

        return view('pages.admin.organisasi.index', compact('organisasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.organisasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'about' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'core_values' => 'required|string',
            'focus_areas' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string',
            'qris_image' => 'required|image|max:2048|mimes:jpeg,png,jpg',
            'qris_name' => 'required|string|max:255',
            'qris_info' => 'required|string',
            'image' => 'required|image|max:2048|mimes:jpeg,png,jpg',
        ],[
            'name.required' => "Nama organisasi wajib diisi.",
            'name.string' => "Nama organisasi harus berupa teks.",
            'name.max' => "Nama organisasi maksimal 255 karakter.",
            'about.required' => "Deskripsi organisasi wajib diisi.",
            'about.string' => "Deskripsi organisasi harus berupa teks.",
            'visi.required' => "Visi organisasi wajib diisi.",
            'visi.string' => "Visi organisasi harus berupa teks.",
            'misi.required' => "Misi organisasi wajib diisi.",
            'misi.string' => "Misi organisasi harus berupa teks.",
            'core_values.required' => "Core values organisasi wajib diisi.",
            'core_values.string' => "Core values organisasi harus berupa teks.",
            'focus_areas.required' => "Focus areas organisasi wajib diisi.",
            'focus_areas.string' => "Focus areas organisasi harus berupa teks.",
            'contact_email.required' => "Email kontak organisasi wajib diisi.",
            'contact_email.email' => "Email kontak organisasi harus berupa email.",
            'contact_phone.required' => "Nomor telepon kontak organisasi wajib diisi.",
            'contact_phone.string' => "Nomor telepon kontak organisasi harus berupa teks.",
            'qris_image.required' => "QRIS organisasi wajib diisi.",
            'qris_image.image' => "QRIS organisasi harus berupa gambar.",
            'qris_image.max' => "Ukuran QRIS organisasi maksimal 2MB.",
            'qris_image.mimes' => "QRIS organisasi harus berformat jpeg, png, atau jpg.",
            'qris_name.required' => "Nama QRIS organisasi wajib diisi.",
            'qris_name.string' => "Nama QRIS organisasi harus berupa teks.",
            'qris_name.max' => "Nama QRIS organisasi maksimal 255 karakter.",
            'qris_info.required' => "Informasi QRIS organisasi wajib diisi.",
            'qris_info.string' => "Informasi QRIS organisasi harus berupa teks.",
            'image.required' => "Logo organisasi wajib diisi.",
            'image.image' => "Logo organisasi harus berupa gambar.",
            'image.max' => "Ukuran logo organisasi maksimal 2MB.",
            'image.mimes' => "Logo organisasi harus berformat jpeg, png, atau jpg.",
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('organisasi', 'public');
            $validatedData['image'] = $imagePath;
        }

        if ($request->hasFile('qris_image')) {
            $imagePath = $request->file('qris_image')->store('organisasi/qris', 'public');
            $validatedData['qris_image'] = $imagePath;
        }

        Organisasi::create($validatedData);

        return redirect()->route('admin.organisasi.index')->with('success', 'Organisasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Organisasi $organisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $organisasi = Organisasi::findOrFail($id);
        return view('pages.admin.organisasi.edit', compact('organisasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $organisasi = Organisasi::findOrFail($id);
           $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'about' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'core_values' => 'required|string',
            'focus_areas' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string',
            'qris_image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
            'qris_name' => 'required|string|max:255',
            'qris_info' => 'required|string',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
        ],[
            'name.required' => "Nama organisasi wajib diisi.",
            'name.string' => "Nama organisasi harus berupa teks.",
            'name.max' => "Nama organisasi maksimal 255 karakter.",
            'about.required' => "Deskripsi organisasi wajib diisi.",
            'about.string' => "Deskripsi organisasi harus berupa teks.",
            'visi.required' => "Visi organisasi wajib diisi.",
            'visi.string' => "Visi organisasi harus berupa teks.",
            'misi.required' => "Misi organisasi wajib diisi.",
            'misi.string' => "Misi organisasi harus berupa teks.",
            'core_values.required' => "Core values organisasi wajib diisi.",
            'core_values.string' => "Core values organisasi harus berupa teks.",
            'focus_areas.required' => "Focus areas organisasi wajib diisi.",
            'focus_areas.string' => "Focus areas organisasi harus berupa teks.",
            'contact_email.required' => "Email kontak organisasi wajib diisi.",
            'contact_email.email' => "Email kontak organisasi harus berupa email.",
            'contact_phone.required' => "Nomor telepon kontak organisasi wajib diisi.",
            'contact_phone.string' => "Nomor telepon kontak organisasi harus berupa teks.",
            'qris_image.image' => "QRIS organisasi harus berupa gambar.",
            'qris_image.max' => "Ukuran QRIS organisasi maksimal 2MB.",
            'qris_image.mimes' => "QRIS organisasi harus berformat jpeg, png, atau jpg.",
            'qris_name.required' => "Nama QRIS organisasi wajib diisi.",
            'qris_name.string' => "Nama QRIS organisasi harus berupa teks.",
            'qris_name.max' => "Nama QRIS organisasi maksimal 255 karakter.",
            'qris_info.required' => "Informasi QRIS organisasi wajib diisi.",
            'qris_info.string' => "Informasi QRIS organisasi harus berupa teks.",
            'image.image' => "Logo organisasi harus berupa gambar.",
            'image.max' => "Ukuran logo organisasi maksimal 2MB.",
            'image.mimes' => "Logo organisasi harus berformat jpeg, png, atau jpg.",
        ]);

        if ($request->hasFile('image')) {
            if ($organisasi->image) {
                Storage::delete('public/' . $organisasi->image);
            }
            $imagePath = $request->file('image')->store('organisasi', 'public');
            $validatedData['image'] = $imagePath;
        } else {
            unset($validatedData['image']);
        }

        if ($request->hasFile('qris_image')) {
            if ($organisasi->image) {
                Storage::delete('public/' . $organisasi->image);
            }
            $imagePath = $request->file('qris_image')->store('organisasi/qris', 'public');
            $validatedData['qris_image'] = $imagePath;
        } else {
            unset($validatedData['qris_image']);
        }

        $organisasi->update($validatedData);

        return redirect()->route('admin.organisasi.index')->with('success', 'Organisasi berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $organisasi->delete();

        return redirect()->route('admin.organisasi.index')->with('success', 'Organisasi berhasil dihapus.');
    }
}
