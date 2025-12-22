<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $guarded = [];
    protected $casts = [
        'positions' => 'array',
    ];

    public function volunter_register()
    {
        return $this->hasMany(VolunterRegister::class);
    }
}
