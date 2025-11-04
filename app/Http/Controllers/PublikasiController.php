<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publikasis = Publikasi::whereIn('status_publikasi', ['Published', 'Hidden'])->orderBy('title', 'asc')->paginate(10);
        return view('pages.admin.publikasi.index', compact('publikasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.publikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status_publikasi' => 'required|in:Published,Hidden',
            'author' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'title.required' => 'Judul publikasi wajib diisi.',
            'title.max' => 'Judul publikasi maksimal 255 karakter.',
            'title.string' => 'Judul publikasi harus berupa teks.',
            'description.required' => 'Deskripsi publikasi wajib diisi.',
            'description.string' => 'Deskripsi publikasi harus berupa teks.',
            'status_publikasi.required' => 'Status publikasi wajib diisi.',
            'status_publikasi.in' => 'Status publikasi harus berupa "Published" atau "Hidden".',
            'author.required' => 'Penulis wajib diisi.',
            'author.string' => 'Penulis harus berupa teks.',
            'author.max' => 'Penulis maksimal 255 karakter.',
            'image.required' => 'Gambar publikasi wajib diisi.',
            'image.image' => 'Gambar publikasi harus berupa gambar.',
            'image.mimes' => 'Gambar publikasi harus berupa JPEG, PNG, atau JPG.',
            'image.max' => 'Ukuran gambar publikasi maksimal 2MB.',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('program', 'public');
            $validatedData['image'] = $imagePath;
        }

        $slug = Str::slug($validatedData['title']);

        Publikasi::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'status_publikasi' => $validatedData['status_publikasi'],
            'author' => $validatedData['author'],
            'slug' => $slug,
            'image' => $validatedData['image'],
        ]);

        return redirect()->route('admin.publikasi.index')->with('success', 'Publikasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publikasi $publikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $publikasis = Publikasi::findOrFail($id);
        $status_publikasi = [
            'Published' => 'Published',
            'Hidden' => 'Hidden',
        ];

        return view('pages.admin.publikasi.edit', compact('publikasis', 'status_publikasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $publikasis = Publikasi::findOrFail($id);

         $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status_publikasi' => 'required|in:Published,Hidden',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'title.required' => 'Judul publikasi wajib diisi.',
            'title.max' => 'Judul publikasi maksimal 255 karakter.',
            'title.string' => 'Judul publikasi harus berupa teks.',
            'description.required' => 'Deskripsi publikasi wajib diisi.',
            'description.string' => 'Deskripsi publikasi harus berupa teks.',
            'status_publikasi.required' => 'Status publikasi wajib diisi.',
            'status_publikasi.in' => 'Status publikasi harus berupa "Published" atau "Hidden".',
            'author.required' => 'Penulis wajib diisi.',
            'author.string' => 'Penulis harus berupa teks.',
            'author.max' => 'Penulis maksimal 255 karakter.',
            'image.required' => 'Gambar publikasi wajib diisi.',
            'image.image' => 'Gambar publikasi harus berupa gambar.',
            'image.mimes' => 'Gambar publikasi harus berupa JPEG, PNG, atau JPG.',
            'image.max' => 'Ukuran gambar publikasi maksimal 2MB.',
        ]);

        // Handle gambar
        if ($request->hasFile('image')) {
            if ($publikasis->image) {
                Storage::delete('public/' . $publikasis->image);
            }
            $imagePath = $request->file('image')->store('program', 'public');
            $validatedData['image'] = $imagePath;
        } else {
            unset($validatedData['image']);
        }

        $slug = Str::slug($validatedData['title']);

        $publikasis->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'status_publikasi' => $validatedData['status_publikasi'],
            'author' => $validatedData['author'],
            'slug' => $slug,
            'image' => $validatedData['image'] ?? $publikasis->image,
        ]);

        return redirect()->route('admin.publikasi.index')->with('success', 'Publikasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publikasis = Publikasi::findOrFail($id);
        $publikasis->delete();

        return redirect()->route('admin.publikasi.index')->with('success', 'Publikasi berhasil dihapus.');
    }
}
