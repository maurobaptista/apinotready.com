<?php

namespace App\Http\Livewire\Endpoint;

use App\Models\Endpoint;
use App\Models\User;
use App\Rules\EndpointIsUnique;
use App\Rules\MethodIsValid;
use App\Rules\CodeIsValid;
use App\Rules\SegmentIsValid;
use Illuminate\View\View;
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
    public $code = 200;

    /** @var string */
    public $body = '';

    /** @var array[] */
    public $endpoint;

    /** @var bool */
    public $recentCreatedEndpoint = false;

    /** @var string[] */
    protected $listeners = [
        'endpointCreated' => 'showEndpointCreated'
    ];

    /** @var string[] */
    protected $cats = [
        'body' => 'json',
    ];

    public function updated(string $field): void
    {
        $this->validateOnly($field, $this->rules());
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.endpoint.create', [
            'methods' => array_combine(config('endpoint.methods'), config('endpoint.methods')),
            'responses' => config('endpoint.responses'),
        ]);
    }

    /**
     * Listener
     */
    public function showEndpointCreated(): void
    {
        $this->recentCreatedEndpoint = true;
    }

    /**
     * Store endpoint and its initial response
     */
    public function store(): void
    {
        $validated = collect($this->validate($this->rules()));

        if (! empty($this->email)) {
            $validated['user_id'] = User::firstOrCreate(['email' => $this->email])->id;
        }

        $endpoint = Endpoint::create(
            $validated->only('user_id', 'segments', 'method')->toArray()
        );

        $validated['active'] = true;
        $endpoint->responses()->create(
            $validated->only('code', 'body', 'active')->toArray()
        );

        $this->endpoint = $endpoint->fresh()->toArray();

        $this->emit('endpointCreated');
    }

    /**
     * @return array
     */
    private function rules(): array
    {
        $unique = new EndpointIsUnique($this->segments, $this->method, $this->email);

        return [
            'email' => ['nullable', 'email', $unique],
            'segments' => [
                'required',
                'regex:/^[a-zA-Z0-9\-\_\/\.\#\=\?\&]+$/i',
                'min:2',
                'max:256',
                new SegmentIsValid,
                $unique
            ],
            'method' => ['required', new MethodIsValid, $unique],
            'code' => ['required', new CodeIsValid],
            'body' => ['json'],
        ];
    }
}
