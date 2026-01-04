<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Programs extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Casting tanggal
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'is_registrasi' => 'boolean',
    ];

    public function regisProgram(): HasMany
    {
        return $this->hasMany(ProgramsRegistrasi::class, 'program_id');
    }
}
