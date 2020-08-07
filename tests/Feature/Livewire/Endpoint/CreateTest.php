<?php

use App\Http\Livewire\Endpoint\Create;
use App\Models\Endpoint;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Livewire\livewire;

it('properly saves data when submitted with no email')
    ->livewire(Create::class)
    ->set('email', null)
    ->set('segments', '/test')
    ->set('method', 'POST')
    ->set('code', 201)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertSet('endpoint', [
        'hash' => 'DJ4MZ3LZ8K',
        'user' => null,
        'segments' => 'test',
        'method' => 'POST',
        'code' => 201,
        'body' => ["message" => "success"],
        'url' => 'http://api.apinotready.localhost/DJ4MZ3LZ8K/test',
    ])
    ->assertEmitted('endpointCreated')
    ->emit('endpointCreated')
    ->assertSet('recentCreatedEndpoint', true);

it('properly saves data when submitted with email')
    ->livewire(Create::class)
    ->set('email', 'john.doe@sample.com')
    ->set('segments', '/test')
    ->set('method', 'POST')
    ->set('code', 201)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertSet('endpoint', [
        'hash' => 'DJ4MZ3LZ8K',
        'user' => '45EG523LPK',
        'segments' => 'test',
        'method' => 'POST',
        'code' => 201,
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
    ->set('code', 201)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['email' => 'email']);

it('asserts segment is required')
    ->livewire(Create::class)
    ->set('method', 'POST')
    ->set('code', 201)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['segments' => 'required'])
;
it('asserts segment is greater than 2 chars')
    ->livewire(Create::class)
    ->set('segments', '/')
    ->set('method', 'POST')
    ->set('code', 201)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['segments' => 'min']);

it('asserts segment is shorter than 256 chars')
    ->livewire(Create::class)
    ->set('segments', str_repeat( 'a', 257))
    ->set('method', 'POST')
    ->set('code', 201)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['segments' => 'max']);

it('asserts method is required')
    ->livewire(Create::class)
    ->set('segments', '/test')
    ->set('method', null)
    ->set('code', 201)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['method' => 'required']);

it('asserts method is valid')
    ->livewire(Create::class)
    ->set('segments', '/test')
    ->set('method', 'INVALID')
    ->set('code', 999)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['method' => 'app\_rules\_method_is_valid']);

it('asserts code is required')
    ->livewire(Create::class)
    ->set('segments', '/test')
    ->set('method', 'POST')
    ->set('body', '{"message": "success"}')
    ->set('code', null)
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['code' => 'required']);

it('asserts code is valid')
    ->livewire(Create::class)
    ->set('segments', '/test')
    ->set('method', 'POST')
    ->set('code', 999)
    ->set('body', '{"message": "success"}')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['code' => 'app\_rules\_code_is_valid']);

it('asserts body is json')
    ->livewire(Create::class)
    ->set('segments', '/test')
    ->set('method', 'POST')
    ->set('code', 201)
    ->set('body', 'invalid-value')
    ->call('store')
    ->assertNotEmitted('endpointCreated')
    ->assertHasErrors(['body' => 'json']);

it('fails if endpoint already exists for user', function () {
    factory(User::class)->create([
        'id' => 1,
        'email' => 'john.doe@sample.com',
    ]);
    factory(Endpoint::class)->create([
        'id' => 1,
        'user_id' => 1,
        'segments' => 'test',
        'method' => 'POST'
    ]);

    livewire(Create::class)
        ->set('email', 'john.doe@sample.com')
        ->set('segments', 'test')
        ->set('method', 'POST')
        ->set('code', 201)
        ->set('body', '{"message": "success"}')
        ->call('store')
        ->assertNotEmitted('endpointCreated')
        ->assertHasErrors(['email' => 'app\_rules\_endpoint_is_unique'])
        ->assertHasErrors(['segments' => 'app\_rules\_endpoint_is_unique'])
        ->assertHasErrors(['method' => 'app\_rules\_endpoint_is_unique']);
});

