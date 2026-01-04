<?php

namespace App\Exports;

use App\Models\ProgramsRegistrasi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProgramsRegistrasiExport implements FromQuery, WithHeadings, WithMapping
{
    protected $programId;

    public function __construct($programId = null)
    {
        $this->programId = $programId;
    }

    public function query()
    {
        $query = ProgramsRegistrasi::with('program')
            ->whereHas('program', function ($q) {
                $q->where('slug', 'like', '%offline%')
                  ->orWhere('slug', 'like', '%online%');
            });

        // Filter berdasarkan program (jika dipilih)
        if (!empty($this->programId)) {
            $query->where('program_id', $this->programId);
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            'Nama Peserta',
            'Email',
            'No. WhatsApp',
            'Program',
            'Tanggal Daftar',
        ];
    }

    public function map($registrasi): array
    {
        return [
            $registrasi->name,
            $registrasi->email,
            $registrasi->phone,
            $registrasi->program ? $registrasi->program->title : '-',
            $registrasi->created_at
                ? $registrasi->created_at->format('d F Y')
                : '-',
        ];
    }
}
