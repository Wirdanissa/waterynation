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

    public function index()
    {
        $programs = Programs::whereIn('status_publikasi', ['Published', 'Hidden'])->orderBy('title', 'asc')->paginate(10);
        return view('pages.admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('pages.admin.programs.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:Offline Action,Online Webinar,Modul Development For Kids',
            'status_publikasi' => 'required|in:Published,Hidden',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'link_url' => 'nullable|url',
            'lokasi' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('program', 'public');
        }

        $slug = Str::slug($validatedData['title']);

        Programs::create([
            'title' => $validatedData['title'],
            'slug' => $slug,
            'description' => $validatedData['description'],
            'category' => $validatedData['category'],
            'status_publikasi' => $validatedData['status_publikasi'],
            'image' => $validatedData['image'],
            'link_url' => $request->link_url, // PERBAIKAN: Langsung dari request
            'lokasi' => $validatedData['lokasi'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
        ]);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function show(string $slug)
    {
        $programs = Programs::where('slug', $slug)->firstOrFail();
        $rekomendasi = Programs::where('status_publikasi', 'Published')
            ->where('id', '!=', $programs->id)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        // PERBAIKAN: Menghapus spasi dan memastikan nama route benar
        $routes = [
            'Offline Action' => 'programs.offline-action',
            'Online Webinar' => 'programs.online-webinar',
            'Modul Development For Kids' => 'programs.modul-development-for-kids',
        ];

        $backRouteName = $routes[$programs->category] ?? 'programs.offline-action';
        $backRoute = route($backRouteName);

        $menuMap = [
            'Offline Action' => 'menuOfflineAction',
            'Online Webinar' => 'menuOnlineWebinar',
            'Modul Development For Kids' => 'menuModulDevelopmentForKids',
        ];

        $activeMenu = $menuMap[$programs->category] ?? null;
        return view('pages.guest.program.detail', compact('programs','rekomendasi', 'backRoute', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $programs = Programs::findOrFail($id);
        $status_publikasi = ['Published' => 'Published', 'Hidden' => 'Hidden'];
        $category = [
            'Offline Action' => 'Offline Action',
            'Online Webinar' => 'Online Webinar',
            'Modul Development For Kids' => 'Modul Development For Kids',
        ];
        return view('pages.admin.programs.edit', compact('programs', 'status_publikasi', 'category'));
    }

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
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($request->hasFile('image')) {
            if ($programs->image) { Storage::delete('public/' . $programs->image); }
            $validatedData['image'] = $request->file('image')->store('program', 'public');
        }

        $programs->update([
            'title' => $validatedData['title'],
            'slug' => Str::slug($validatedData['title']),
            'description' => $validatedData['description'],
            'category' => $validatedData['category'],
            'status_publikasi' => $validatedData['status_publikasi'],
            'image' => $validatedData['image'] ?? $programs->image,
            'link_url' => $request->link_url, // PERBAIKAN: Langsung dari request
            'lokasi' => $validatedData['lokasi'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
        ]);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $programs = Programs::findOrFail($id);
        if ($programs->image) { Storage::delete('public/' . $programs->image); }
        $programs->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil dihapus.');
    }
}