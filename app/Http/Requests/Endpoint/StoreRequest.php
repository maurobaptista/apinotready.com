<?php

namespace App\Http\Requests\Endpoint;

use Facades\App\Helpers\Endpoint;
use App\Rules\MethodIsValid;
use App\Rules\CodeIsValid;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['nullable', 'email'],
            'endpoint' => ['required', 'min:2', 'max:256'],
            'method' => ['required', new MethodIsValid],
            'response' => ['required', new CodeIsValid],
            'body' => ['required', 'json'],
        ];
    }
}
