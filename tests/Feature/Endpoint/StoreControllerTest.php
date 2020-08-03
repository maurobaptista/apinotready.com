<?php

use Facades\App\Helpers\Endpoint;
use function Pest\Laravel\{postJson, assertDatabaseHas};


it('creates an endpoint creating an user', function () {
    $response = postJson('/endpoints', [
        'email' => 'john.doe@sample.com',
        'endpoint' => '/test',
        'method' => 'POST',
        'response' => 201,
        'body' => '{"message": "success"}',
    ]);

    $response->assertStatus(201);
    $response->assertExactJson([
        'hash' => 'DJ4MZ3LZ8K',
        'method' => 'POST',
        'response' => 201,
        'body' => '{"message": "success"}',
        'url' => 'http://45EG523LPK.apinotready.localhost/test',
    ]);
    assertDatabaseHas('endpoints', [
        'user_id' => 1,
        'endpoint' => '/test',
        'method' => 'POST',
        'response' => 201,
        'body' => '{"message": "success"}',
    ]);
    assertDatabaseHas('users', [
        'email' => 'john.doe@sample.com',
    ]);
});

it('creates an endpoint reusing an user', function () {
    factory(\App\Models\User::class)->create([
        'id' => 999,
        'email' => 'john.doe@sample.com',
    ]);
    $response = postJson('/endpoints', [
        'email' => 'john.doe@sample.com',
        'endpoint' => '/test',
        'method' => 'POST',
        'response' => 201,
        'body' => '{"message": "success"}',
    ]);

    $response->assertStatus(201);
    $response->assertExactJson([
        'hash' => 'DJ4MZ3LZ8K',
        'method' => 'POST',
        'response' => 201,
        'body' => '{"message": "success"}',
        'url' => 'http://REG9MQ5G2J.apinotready.localhost/test',
    ]);
    assertDatabaseHas('endpoints', [
        'user_id' => 999,
        'endpoint' => '/test',
        'method' => 'POST',
        'response' => 201,
        'body' => '{"message": "success"}',
    ]);
});

it('fails if email is not valid', function () {
    $response = postJson('/endpoints', [
        'email' => 'invalid-email',
        'endpoint' => '/test',
        'method' => 'POST',
        'response' => 201,
        'body' => '{"message": "success"}',
    ]);

    $response->assertStatus(422);
    $response->assertJson([
        'errors' => [
            'email' => [
                'The email must be a valid email address.'
            ],
        ],
    ]);
});

it('fails if endpoint is too short', function () {
    $response = postJson('/endpoints', [
        'email' => null,
        'endpoint' => 'a',
        'method' => 'POST',
        'response' => 201,
        'body' => '{"message": "success"}',
    ]);

    $response->assertStatus(422);
    $response->assertJson([
        'errors' => [
            'endpoint' => [
                'The endpoint must be at least 2 characters.'
            ],
        ],
    ]);
});

it('fails if endpoint is too big', function () {
    $response = postJson('/endpoints', [
        'email' => null,
        'endpoint' => str_repeat('a', 257),
        'method' => 'POST',
        'response' => 201,
        'body' => '{"message": "success"}',
    ]);

    $response->assertStatus(422);
    $response->assertJson([
        'errors' => [
            'endpoint' => [
                'The endpoint may not be greater than 256 characters.'
            ],
        ],
    ]);
});

it('fails if method is invalid', function () {
    $response = postJson('/endpoints', [
        'email' => null,
        'endpoint' => '/test',
        'method' => 'INVALID',
        'response' => 201,
        'body' => '{"message": "success"}',
    ]);

    $response->assertStatus(422);
    $response->assertJson([
        'errors' => [
            'method' => [
                'The method is invalid'
            ],
        ],
    ]);
});

it('fails if response is invalid', function () {
    $response = postJson('/endpoints', [
        'email' => null,
        'endpoint' => '/test',
        'method' => 'POST',
        'response' => 999,
        'body' => '{"message": "success"}',
    ]);

    $response->assertStatus(422);
    $response->assertJson([
        'errors' => [
            'response' => [
                'The response is invalid'
            ],
        ],
    ]);
});
