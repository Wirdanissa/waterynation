<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    protected $guarded = [];

    public function regisProgram(){
        return $this->hasMany(ProgramsRegistrasi::class);
    }
}
