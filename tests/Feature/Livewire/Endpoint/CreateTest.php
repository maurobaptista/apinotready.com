<?php

use App\Http\Livewire\Endpoint\Create;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

it('properly saves data when submitted with no email')
    ->livewire(Create::class)
    ->set('email', null)
    ->set('segments', '/test')
    ->set('method', 'POST')
    ->set('response', 201)
    ->set('body', '{"message": "success"}')
    ->call('submit')
    ->assertSet('endpoint', [
        'user' => null,
        'segments' => 'DJ4MZ3LZ8K/test',
        'method' => 'POST',
        'response' => 201,
        'body' => ["message" => "success"],
        'url' => 'http://apinotready.localhost/api/DJ4MZ3LZ8K/test',
    ])
    ->assertEmitted('endpointCreated')
    ->emit('endpointCreated')
    ->assertSet('recentCreatedEndpoint', true);

it('properly saves data when submitted with email')
    ->livewire(Create::class)
    ->set('email', 'john.doe@sample.com')
    ->set('segments', '/test')
    ->set('method', 'POST')
    ->set('response', 201)
    ->set('body', '{"message": "success"}')
    ->call('submit')
    ->assertSet('endpoint', [
        'user' => '45EG523LPK',
        'segments' => 'test',
        'method' => 'POST',
        'response' => 201,
        'body' => ["message" => "success"],
        'url' => 'http://45EG523LPK.apinotready.localhost/test',
    ])
    ->assertEmitted('endpointCreated')
    ->emit('endpointCreated')
    ->assertSet('recentCreatedEndpoint', true)
    ->only();
