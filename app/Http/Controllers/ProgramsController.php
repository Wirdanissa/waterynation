<?php

namespace App\Http\Controllers;

use App\Models\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramsController extends Controller
{

    public function offlineAction()
    {
        $offlineAction = Programs::where('category', 'Offline Action')
            ->where('status_publikasi','Published')
            ->paginate(12);
        return view('pages.guest.program.offline', compact('offlineAction'));
    }

    public function onlineWebinar()
    {
        $onlineWebinar = Programs::where('category', 'Online Webinar')
            ->where('status_publikasi','Published')
            ->paginate(12);
        return view('pages.guest.program.online', compact('onlineWebinar'));
    }

    public function modulDevelopmentForKids()
    {
        $modulDevelopmentForKids = Programs::where('category', 'Modul Development For Kids')
            ->where('status_publikasi','Published')
            ->paginate(12);
        return view('pages.guest.program.modul', compact('modulDevelopmentForKids'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Programs::whereIn('status_publikasi', ['Published', 'Hidden'])->orderBy('title', 'asc')->paginate(10);
        return view('pages.admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:Offline Action,Online Webinar,Modul Development For Kids',
            'status_publikasi' => 'required|in:Published,Hidden',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'link_url' => 'nullable|url',
            'lokasi' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ],[
            'title.required' => 'Judul program wajib diisi.',
            'title.max' => 'Judul program maksimal 255 karakter.',
            'title.string' => 'Judul program harus berupa teks.',
            'description.required' => 'Deskripsi program wajib diisi.',
            'description.string' => 'Deskripsi program harus berupa teks.',
            'category.required' => 'Kategori program wajib diisi.',
            'category.in' => 'Kategori program harus salah satu dari Offline Action, Online Webinar, Modul Development For Kids.',
            'status_publikasi.required' => 'Status publikasi wajib diisi.',
            'status_publikasi.in' => 'Status publikasi harus salah satu dari Published atau Hidden.',
            'image.required' => 'Gambar program wajib diisi.',
            'image.image' => 'Gambar program harus berupa gambar.',
            'image.mimes' => 'Gambar program harus berformat jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar program maksimal 2MB.',
            'link_url.url' => 'URL program harus berupa URL.',
            'lokasi.required' => 'Lokasi program wajib diisi.',
            'lokasi.string' => 'Lokasi program harus berupa teks.',
            'start_date.required' => 'Tanggal mulai program wajib diisi.',
            'start_date.date' => 'Tanggal mulai program harus berupa tanggal.',
            'start_date.after_or_equal' => 'Tanggal mulai program harus setelah tanggal sekarang.',
            'end_date.required' => 'Tanggal selesai program wajib diisi.',
            'end_date.date' => 'Tanggal selesai program harus berupa tanggal.',
            'end_date.after_or_equal' => 'Tanggal selesai program harus setelah tanggal mulai program.',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('program', 'public');
            $validatedData['image'] = $imagePath;
        }

        $slug = Str::slug($validatedData['title']);

        $programs = Programs::create([
            'title' => $validatedData['title'],
            'slug' => $slug,
            'description' => $validatedData['description'],
            'category' => $validatedData['category'],
            'status_publikasi' => $validatedData['status_publikasi'],
            'image' => $validatedData['image'],
            'link_url' => $validatedData['link_url'],
            'lokasi' => $validatedData['lokasi'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
        ]);

        return redirect()->route('admin.program.index')->with('success', 'Program berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $programs = Programs::where('slug', $slug)->firstOrFail();
        $rekomendasi = Programs::where('status_publikasi', 'Published')->where('id', '!=', $programs->id)->inRandomOrder()->limit(5)->get();
        $routes = [
            'Offline Action' => '   offline-action',
            'Online Webinar' => '   online-webinar',
            'Modul Development For Kids' => '   modul-development-for-kids',
        ];

        // rute kembali berdasarkan kategori
        $backRoute = $routes[$programs->category] ?? 'programs.offline-action';

        $menuMap = [
            'Offline Action' => 'menuOfflineAction',
            'Online Webinar' => 'menuOnlineWebinar',
            'Modul Development For Kids' => 'menuModulDevelopmentForKids',
        ];

        $activeMenu = $menuMap[$programs->category] ?? null;
        return view('pages.guest.program.detail', compact('programs','rekomendasi', 'backRoute', 'activeMenu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $programs = Programs::findOrFail($id);
        $status_publikasi = [
            'Published' => 'Published',
            'Hidden' => 'Hidden',
        ];
        $category = [
            'Offline Action' => 'Offline Action',
            'Online Webinar' => 'Online Webinar',
            'Modul Development For Kids' => 'Modul Development For Kids',
        ];

        return view('pages.admin.programs.edit', compact('programs', 'status_publikasi', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $programs = Programs::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:Offline Action,Online Webinar,Modul Development For Kids',
            'status_publikasi' => 'required|in:Published,Hidden',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'link_url' => 'nullable|url',
            'lokasi' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ],[
            'title.required' => 'Judul program wajib diisi.',
            'title.max' => 'Judul program maksimal 255 karakter.',
            'title.string' => 'Judul program harus berupa teks.',
            'description.required' => 'Deskripsi program wajib diisi.',
            'description.string' => 'Deskripsi program harus berupa teks.',
            'category.required' => 'Kategori program wajib diisi.',
            'category.in' => 'Kategori program harus salah satu dari Offline Action, Online Webinar, Modul Development For Kids.',
            'status_publikasi.required' => 'Status publikasi wajib diisi.',
            'status_publikasi.in' => 'Status publikasi harus salah satu dari Published atau Hidden.',
            'image.required' => 'Gambar program wajib diisi.',
            'image.image' => 'Gambar program harus berupa gambar.',
            'image.mimes' => 'Gambar program harus berformat jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar program maksimal 2MB.',
            'link_url.url' => 'URL program harus berupa URL.',
            'lokasi.required' => 'Lokasi program wajib diisi.',
            'lokasi.string' => 'Lokasi program harus berupa teks.',
            'start_date.required' => 'Tanggal mulai program wajib diisi.',
            'start_date.date' => 'Tanggal mulai program harus berupa tanggal.',
            'start_date.after_or_equal' => 'Tanggal mulai program harus setelah tanggal sekarang.',
            'end_date.required' => 'Tanggal selesai program wajib diisi.',
            'end_date.date' => 'Tanggal selesai program harus berupa tanggal.',
            'end_date.after_or_equal' => 'Tanggal selesai program harus setelah tanggal mulai program.',
        ]);

        // Handle gambar
        if ($request->hasFile('image')) {
            if ($programs->image) {
                Storage::delete('public/' . $programs->image);
            }
            $imagePath = $request->file('image')->store('program', 'public');
            $validatedData['image'] = $imagePath;
        } else {
            unset($validatedData['image']);
        }

        $slug = Str::slug($validatedData['title']);

        $programs->update([
            'title' => $validatedData['title'],
            'slug' => $slug,
            'description' => $validatedData['description'],
            'category' => $validatedData['category'],
            'status_publikasi' => $validatedData['status_publikasi'],
            'image' => $validatedData['image'] ?? $programs->image,
            'link_url' => $validatedData['link_url'],
            'lokasi' => $validatedData['lokasi'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
        ]);
        return redirect()->route('admin.program.index')->with('success', 'Program berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $programs = Programs::findOrFail($id);
        $programs->delete();

        return redirect()->route('admin.program.index')->with('success', 'Program berhasil dihapus.');
    }
}
