<?php

namespace App\Http\Controllers;

use App\Domain\Prospect\Mail\NewProspect;
use App\Domain\Prospect\Models\Prospect;
use App\Domain\Prospect\Requests\CreateProspectRequest;
use Illuminate\Support\Facades\Mail;

class ProspectsController extends Controller
{
    public function store(CreateProspectRequest $request)
    {
        $prospect = Prospect::create($request->toCommand());

        Mail::to('kfriars@gmail.com')->send(new NewProspect($prospect));

        return response()->json([], 201);
    }
}
