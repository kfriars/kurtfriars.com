<?php

namespace App\Domain\Prospect\Mail;

use App\Domain\Prospect\Models\Prospect;
use App\Mail\AbstractMailable;

class NewProspect extends AbstractMailable
{
    public function __construct(Prospect $prospect)
    {
        $this->message = $this->message();
        
        $this->message->setCopy('email/prospect/new', [
            'email' => $prospect->email,
            'message' => $prospect->message,
        ]);

        $this->message->setSubject('subject')
                ->setTitle('title')
                ->setFeatureText('subtitle')
                ->addSection()
                ->addHeading('prospect_heading')
                ->addParagraphs('email')
                ->addSection();

        if (! empty($prospect->message)) {
            $this->message->addHeading('message_heading')
                          ->addParagraphs('message');
        }
    }
}
