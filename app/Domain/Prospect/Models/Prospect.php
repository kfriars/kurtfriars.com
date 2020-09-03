<?php

namespace App\Domain\Prospect\Models;

use App\Domain\Prospect\DTO\CreateProspectCommand;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    /**
     * Create a new prospect
     *
     * @param CreateProspectCommand $command
     *
     * @return Prospect
     */
    public static function create(CreateProspectCommand $command) : Prospect
    {
        $prospect = new self();
        $prospect->email = $command->email;
        $prospect->message = $command->message;
        $prospect->save();

        return $prospect;
    }
}
