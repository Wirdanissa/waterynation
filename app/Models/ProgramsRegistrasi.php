<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramsRegistrasi extends Model
{
    protected $fillable = [
        'program_id',
        'name',
        'email',
        'phone',
    ];

    /**
     * Relasi ke program
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Programs::class, 'program_id');
    }
}
