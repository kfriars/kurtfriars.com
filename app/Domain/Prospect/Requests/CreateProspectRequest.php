<?php

namespace App\Domain\Prospect\Requests;

use App\Domain\Prospect\DTO\CreateProspectCommand;
use App\Rules\ReCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class CreateProspectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'max:180', 'email'],
            'message' => ['nullable', 'string', 'max:1000'],
            'recaptcha_token' => ['required', 'string', new ReCaptcha],
        ];
    }

    /**
     * Turn the request into a cammand to be processed by the system
     *
     * @return CreateProspectCommand
     */
    public function toCommand() : CreateProspectCommand
    {
        return new CreateProspectCommand($this->input());
    }
}
