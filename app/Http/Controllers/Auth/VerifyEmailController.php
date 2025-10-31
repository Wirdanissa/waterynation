<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Cek apakah email sudah terverifikasi
        if ($user->hasVerifiedEmail()) {
            // Jika sudah terverifikasi, arahkan ke login
            return redirect()->route('login');
        }

        // Tandai email pengguna sebagai terverifikasi
        if ($user->markEmailAsVerified()) {
            // Memicu event Verified
            event(new Verified($user));
        }

        // Logout pengguna setelah verifikasi dan arahkan ke login
        Auth::logout();

        // Arahkan ke halaman login
        return redirect()->route('login')->with('success', 'Email berhasil diverifikasi. Silahkan login.');
    }
}
