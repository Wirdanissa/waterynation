<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $guarded = [];

    public function volunter_register()
    {
        return $this->hasMany(VolunterRegister::class);
    }

    // Accessor untuk positions
    public function getPositionsAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }
}
