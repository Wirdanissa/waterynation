<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VolunteerController extends Controller
{

    // User
    public function volunteerUser()
    {
        $volunteers = Volunteer::where('status_publikasi', 'Published')->orderBy('title', 'asc')->paginate(10);
        // dd($volunteers);
        return view('pages.guest.volunteer.index', compact('volunteers'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $volunteers = Volunteer::whereIn('status_publikasi', ['Published', 'Hidden'])->orderBy('title', 'asc')->paginate(10);
        return view('pages.admin.volunteer.index', compact('volunteers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.volunteer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'positions' => 'required|array|min:1',
            'positions.*' => 'string',
            'status_publikasi' => 'required|in:Published,Hidden',
        ],[
            'title.required' => 'Judul wajib diisi.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'title.string' => 'Judul harus berupa teks.',
            'description.required' => 'Deskripsi wajib diisi.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'image.required' => 'Gambar wajib diisi.',
            'image.image' => 'Gambar harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'positions.required' => 'Posisi wajib diisi.',
            'positions.array' => 'Posisi harus berupa array.',
            'positions.*.string' => 'Setiap posisi harus berupa teks.',
            'status_publikasi.required' => 'Status publikasi wajib diisi.',
            'status_publikasi.in' => 'Status publikasi harus berupa "Published" atau "Hidden".',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('volunteer', 'public');
            $validatedData['image'] = $imagePath;
        }

        $slug = Str::slug($validatedData['title']);

        Volunteer::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'positions' => $validatedData['positions'],
            'status_publikasi' => $validatedData['status_publikasi'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.volunteer.index')->with('success', 'Volunteer berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $volunteers = Volunteer::where('slug', $slug)->firstOrFail();
        $rekomendasi = Volunteer::where('status_publikasi', 'Published')->where('id', '!=', $volunteers->id)->inRandomOrder()->limit(5)->get();
        return view('pages.guest.volunteer.detail', compact('volunteers','rekomendasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $volunteer = Volunteer::findOrFail($id);

        $status_publikasi = [
            'Published' => 'Published',
            'Hidden' => 'Hidden',
        ];

        return view('pages.admin.volunteer.edit', compact('volunteer', 'status_publikasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $volunteer = Volunteer::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'positions' => 'required|array|min:1',
            'positions.*' => 'string',
            'status_publikasi' => 'required|in:Published,Hidden',
        ],[
            'title.required' => 'Judul wajib diisi.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'title.string' => 'Judul harus berupa teks.',
            'description.required' => 'Deskripsi wajib diisi.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'image.image' => 'Gambar harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'positions.required' => 'Posisi wajib diisi.',
            'positions.array' => 'Posisi harus berupa array.',
            'positions.*.string' => 'Setiap posisi harus berupa teks.',
            'status_publikasi.required' => 'Status publikasi wajib diisi.',
            'status_publikasi.in' => 'Status publikasi harus berupa "Published" atau "Hidden".',
        ]);

        if ($request->hasFile('image')) {
            if ($volunteer->image) {
                Storage::delete('public/' . $volunteer->image);
            }
            $imagePath = $request->file('image')->store('volunteer', 'public');
            $validatedData['image'] = $imagePath;
        } else {
            unset($validatedData['image']);
        }

        $slug = Str::slug($validatedData['title']);

        $volunteer->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $volunteer->image,
            'positions' => $validatedData['positions'],
            'status_publikasi' => $validatedData['status_publikasi'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.volunteer.index')->with('success', 'Volunteer berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->delete();

        return redirect()->route('admin.volunteer.index')->with('success', 'Volunteer berhasil dihapus.');
    }
}
