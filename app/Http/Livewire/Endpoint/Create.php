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
    public $segments = '';

    /** @var string */
    public $method = 'GET';

    /** @var int */
    public $response = 200;

    /** @var string */
    public $body = '';

    /** @var Endpoint */
    public $endpoint;

    /** @var bool */
    public $recentCreatedEndpoint = false;

    /** @var string[] */
    protected $listeners = [
        'endpointCreated' => 'showEndpointCreated'
    ];

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

    public function showEndpointCreated(): void
    {
        $this->recentCreatedEndpoint = true;
    }

    public function submit(): void
    {
        $this->validate($this->rules());

        $userId = (empty($this->email))
            ? null
            : User::firstOrCreate(['email' => $this->email])->id;

        $this->endpoint = Endpoint::create([
            'user_id' => $userId,
            'segments' => $this->segments,
            'method' => $this->method,
            'response' => $this->response,
            'body' => $this->body,
        ])->toArray();

        $this->emit('endpointCreated');
    }

    private function rules(): array
    {
        return [
            'email' => ['nullable', 'email'],
            'segments' => ['required', 'min:2', 'max:256'],
            'method' => ['required', new MethodIsValid],
            'response' => ['required', new ResponseIsValid],
            'body' => ['json'],
        ];
    }
}
