<?php

namespace App\Domain\Prospect\DTO;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class CreateProspectCommand extends FlexibleDataTransferObject
{
    public string $email;

    public ?string $message;
}
