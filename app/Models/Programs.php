<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Programs extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Gunakan SLUG sebagai route key
     * agar Route::resource('/programs') tetap bisa
     * dipakai dengan URL /programs/{slug}
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Casting atribut
     */
    protected $casts = [
        'start_date'     => 'date',
        'end_date'       => 'date',
        'is_registrasi'  => 'boolean',
    ];

    /**
     * Relasi ke tabel pendaftaran program
     */
    public function regisProgram(): HasMany
    {
        return $this->hasMany(ProgramsRegistrasi::class, 'program_id');
    }
}
