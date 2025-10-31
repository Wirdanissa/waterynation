<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramsRegistrasi extends Model
{
    protected $guarded = [];

    public function program()
    {
        return $this->belongsTo(Programs::class);
    }
}
