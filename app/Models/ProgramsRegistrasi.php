<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramsRegistrasi extends Model
{
    protected $fillable = [
        'program_id',
        'name',
        'email',
        'phone',
    ];

    public function program()
    {
        return $this->belongsTo(Programs::class, 'program_id');
    }
}

