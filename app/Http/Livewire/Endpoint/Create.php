<?php

namespace App\Http\Livewire\Endpoint;

use App\Models\Endpoint;
use App\Models\User;
use App\Rules\MethodIsValid;
use App\Rules\ResponseIsValid;
use Livewire\Component;

class Create extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $endpoint = '';

    /** @var string */
    public $method = 'GET';

    /** @var int */
    public $response = 200;

    /** @var string */
    public $body = '';

    public function updated(string $field): void
    {
        $this->validateOnly($field, $this->rules());
    }

    public function render()
    {
        return view('livewire.endpoint.create', [
            'methods' => config('endpoint.methods'),
            'responses' => config('endpoint.responses'),
        ]);
    }

    public function submit(): void
    {
        $this->validate($this->rules());

        $userId = (empty($this->email))
            ? null
            : User::firstOrCreate(['email' => $this->email])->id;

        Endpoint::create([
            'user_id' => $userId,
            'endpoint' => $this->endpoint,
            'method' => $this->method,
            'response' => $this->response,
            'body' => $this->body,
        ]);
    }

    private function rules(): array
    {
        return [
            'email' => ['nullable', 'email'],
            'endpoint' => ['required', 'min:2', 'max:256'],
            'method' => ['required', new MethodIsValid],
            'response' => ['required', new ResponseIsValid],
            'body' => ['required', 'json'],
        ];
    }
}
