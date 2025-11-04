<?php

namespace App\Http\Controllers;

use App\Models\ProgramsRegistrasi;
use Illuminate\Http\Request;

class ProgramsRegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programsRegistrasi = ProgramsRegistrasi::paginate(10);
        return view('pages.admin.programs_regis.index', compact('programsRegistrasi'));
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'program_id' => 'required|integer|exists:programs,id',
            'phone' => 'required|string|min:10|max:15',
        ],[
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama lengkap harus berupa teks.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'program_id.required' => 'Program wajib dipilih.',
            'program_id.integer' => 'Program tidak valid.',
            'program_id.exists' => 'Program yang dipilih tidak ada.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.min' => 'Nomor telepon minimal 10 karakter.',
            'phone.max' => 'Nomor telepon maksimal 15 karakter.',
        ]);

        ProgramsRegistrasi::create($validatedData);

        return redirect()->route('admin.programs.index')->with('success', 'Registrasi berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramsRegistrasi $programsRegistrasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramsRegistrasi $programsRegistrasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramsRegistrasi $programsRegistrasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramsRegistrasi $programsRegistrasi)
    {
        //
    }
}
