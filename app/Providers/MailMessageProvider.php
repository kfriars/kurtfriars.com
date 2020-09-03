<?php

namespace App\Providers;

use App\Mail\Message\EmailMessage;
use App\Mail\Message\EmailMessageInterface;
use Illuminate\Support\ServiceProvider;

class MailMessageProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmailMessageInterface::class, EmailMessage::class);
    }
}
