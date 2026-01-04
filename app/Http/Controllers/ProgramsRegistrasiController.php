<?php

namespace App\Http\Controllers;

use App\Models\Programs;
use App\Models\ProgramsRegistrasi;
use Illuminate\Http\Request;
use App\Exports\ProgramsRegistrasiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;

class ProgramsRegistrasiController extends Controller
{
    /**
     * List pendaftar + Dashboard Statistik
     */
    public function index(Request $request)
    {
        // 1. Ambil daftar program untuk dropdown filter
        $programs = Programs::query()
            ->where(function ($q) {
                $q->where('slug', 'like', '%online%')
                  ->orWhere('slug', 'like', '%offline%');
            })
            ->orderBy('title')
            ->get();

        // 2. Query Utama untuk Tabel
        $query = ProgramsRegistrasi::with('program')
            ->whereHas('program', function ($q) {
                $q->where('slug', 'like', '%online%')
                  ->orWhere('slug', 'like', '%offline%');
            });

        // 3. Logic Dashboard Statistik (Sebelum difilter oleh dropdown)
        $statsQuery = clone $query;
        $stats = [
            'total'   => $statsQuery->count(),
            'online'  => (clone $statsQuery)->whereHas('program', function($q) {
                            $q->where('slug', 'like', '%online%');
                         })->count(),
            'offline' => (clone $statsQuery)->whereHas('program', function($q) {
                            $q->where('slug', 'like', '%offline%');
                         })->count(),
        ];

        // 4. Filter dropdown pendaftar
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        $programsRegistrasi = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.programs_regis.index', compact(
            'programsRegistrasi', 
            'programs', 
            'stats'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:10|max:15',
            'program_id' => [
                'required',
                Rule::exists('programs', 'id')->where(function ($q) {
                    $q->where('slug', 'like', '%online%')
                      ->orWhere('slug', 'like', '%offline%');
                }),
            ],
        ]);

        $exists = ProgramsRegistrasi::where([
            'email'      => $request->email,
            'program_id' => $request->program_id,
        ])->exists();

        if ($exists) {
            return back()->withErrors(['email' => 'Anda sudah terdaftar di program ini.']);
        }

        ProgramsRegistrasi::create($request->only(['name', 'email', 'phone', 'program_id']));

        return back()->with('success', 'Registrasi berhasil dikirim.');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new ProgramsRegistrasiExport($request->program_id),
            'pendaftar-program.xlsx'
        );
    }

    public function destroy($id)
    {
        ProgramsRegistrasi::findOrFail($id)->delete();
        return back()->with('success', 'Pendaftar berhasil dihapus.');
    }
}