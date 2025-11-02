<?php

use Carbon\Carbon;

if (!function_exists('format_tanggal')) {
    function tanggal($tanggal, $format = 'd F Y')
    {
        return Carbon::parse($tanggal)->translatedFormat($format);
    }
}

