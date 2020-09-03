<?php

namespace App\Mail;

use App\Mail\Message\EmailMessageInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

abstract class AbstractMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected EmailMessageInterface $message;

    protected function message() : EmailMessageInterface
    {
        return resolve(EmailMessageInterface::class);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() : Mailable
    {
        return $this->subject($this->message->subject())
                    ->view($this->message->view(), $this->message->vars());
    }
}
