<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunterRegister extends Model
{
    protected $guarded = [];

    public function volunter()
    {
        return $this->belongsTo(Volunteer::class);
    }
}
