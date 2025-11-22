<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $guarded = [];

    public function getMaskedNameAttribute()
    {
        if ($this->show_name) {
            return $this->name; // tampilkan asli
        }

        // masking per kata
        $words = explode(' ', $this->name);
        $maskedWords = array_map(function ($word) {
            $first = mb_substr($word, 0, 1);
            $mask = str_repeat('*', max(2, mb_strlen($word) - 1));
            return $first . $mask;
        }, $words);

        return implode(' ', $maskedWords);
    }

}
