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
        /**
         * 1. Ambil daftar program untuk dropdown filter
         *    HANYA program Online & Offline
         */
        $programs = Programs::query()
            ->whereIn('category', [
                'Online Action',
                'Offline Action',
            ])
            ->orderBy('title')
            ->get();

        /**
         * 2. Query utama tabel pendaftar
         */
        $query = ProgramsRegistrasi::with('program')
            ->whereHas('program', function ($q) {
                $q->whereIn('category', [
                    'Online Action',
                    'Offline Action',
                ]);
            });

        /**
         * 3. Statistik dashboard
         *    (TIDAK terpengaruh filter dropdown)
         */
        $statsQuery = clone $query;

        $stats = [
            'total'   => $statsQuery->count(),
            'online'  => (clone $statsQuery)->whereHas('program', function ($q) {
                            $q->where('category', 'Online Action');
                         })->count(),
            'offline' => (clone $statsQuery)->whereHas('program', function ($q) {
                            $q->where('category', 'Offline Action');
                         })->count(),
        ];

        /**
         * 4. Filter dropdown berdasarkan program_id
         */
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        /**
         * 5. Ambil data tabel pendaftar
         */
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

    /**
     * Simpan pendaftaran program (PUBLIC)
     */
    public function store(Request $request)
    {
        /**
         * Validasi input
         */
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:10|max:15',
            'program_id' => [
                'required',
                Rule::exists('programs', 'id'),
            ],
        ]);

        /**
         * Cegah pendaftaran ganda (email + program)
         */
        $exists = ProgramsRegistrasi::where('email', $validated['email'])
            ->where('program_id', $validated['program_id'])
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'email' => 'Anda sudah terdaftar di program ini.',
            ])->withInput();
        }

        /**
         * Simpan data
         */
        ProgramsRegistrasi::create($validated);

        return back()->with('success', 'Registrasi berhasil dikirim.');
    }

    /**
     * Export data ke Excel
     */
    public function exportExcel(Request $request)
    {
        return Excel::download(
            new ProgramsRegistrasiExport($request->program_id),
            'pendaftar-program.xlsx'
        );
    }

    /**
     * Hapus pendaftar
     */
    public function destroy($id)
    {
        ProgramsRegistrasi::findOrFail($id)->delete();

        return back()->with('success', 'Pendaftar berhasil dihapus.');
    }
}
