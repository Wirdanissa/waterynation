<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password; // TAMBAHKAN INI

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Mengatur standar password global untuk seluruh aplikasi
        Password::defaults(function () {
            return Password::min(8)
                ->letters()
                ->numbers()
                ->mixedCase()
                ->symbols(); // Tambahkan ini jika ingin wajib simbol
        });
    }
}