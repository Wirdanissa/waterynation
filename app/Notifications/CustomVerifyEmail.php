<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmail
{
    public function toMail($notifiable)
{
    $verificationUrl = $this->verificationUrl($notifiable);

    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->subject('Verifikasi Email - Watery Nation')
        ->view('vendor.notifications.email', [ // Jalurnya ke folder vendor tadi
            'url' => $verificationUrl,
            'name' => $notifiable->name // Mengirim nama user
        ]);
}
}