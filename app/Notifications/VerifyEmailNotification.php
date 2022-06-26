<?php

namespace App\Notifications;

use App\Mail\EmailVerificationMail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    public $tries = 3;

    protected function buildMailMessage($url)
    {
        return (new MailMessage())
            ->subject("Verify Email")
            ->greeting("Welcome to book management")
            ->action("Click Here to Verify", $url);
    }
}
