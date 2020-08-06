<?php

use App\Http\Livewire\Endpoint\Create;

it('properly saves data when submitted with no email')
    ->livewire(Create::class)
    ->set('email', null)
    ->set('segments', '/test')
    ->set('method', 'POST')
    ->set('response', 201)
    ->set('body', '{"message": "success"}')
    ->call('store')
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
    ->call('store')
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
    ->assertSet('recentCreatedEndpoint', true);

it('asserts email is valid')
    ->livewire(Create::class)
    ->set('email', 'invalid-email')
    ->set('segments', '/test')
    ->set('method', 'POST')
    ->set('response', 201)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['email' => 'email']);

it('asserts segment is required')
    ->livewire(Create::class)
    ->set('method', 'POST')
    ->set('response', 201)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['segments' => 'required'])
;
it('asserts segment is greater than 2 chars')
    ->livewire(Create::class)
    ->set('segments', '/')
    ->set('method', 'POST')
    ->set('response', 201)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['segments' => 'min']);

it('asserts segment is shorter than 256 chars')
    ->livewire(Create::class)
    ->set('segments', str_repeat( 'a', 257))
    ->set('method', 'POST')
    ->set('response', 201)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['segments' => 'max']);

it('asserts method is required')
    ->livewire(Create::class)
    ->set('segments', '/test')
    ->set('method', null)
    ->set('response', 201)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['method' => 'required']);

it('asserts method is valid')
    ->livewire(Create::class)
    ->set('segments', '/test')
    ->set('method', 'INVALID')
    ->set('response', 999)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['method' => 'app\_rules\_method_is_valid']);

it('asserts response is required')
    ->livewire(Create::class)
    ->set('segments', '/test')
    ->set('method', 'POST')
    ->set('body', '{"message": "success"}')
    ->set('response', null)
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['response' => 'required']);

it('asserts response is valid')
    ->livewire(Create::class)
    ->set('segments', '/test')
    ->set('method', 'POST')
    ->set('response', 999)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['response' => 'app\_rules\_response_is_valid']);

it('asserts body is json')
    ->livewire(Create::class)
    ->set('segments', '/test')
    ->set('method', 'POST')
    ->set('response', 999)
    ->set('body', 'invalid-value')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['body' => 'json']);
