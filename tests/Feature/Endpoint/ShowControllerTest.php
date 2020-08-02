<?php

use App\Models\Endpoint;
use App\Models\User;
use function Pest\Laravel\{getJson};

it('loads proper data when called with no user', function () {
    factory(Endpoint::class)->create([
        'user_id' => null,
        'endpoint' => '/abc/test',
        'method' => 'GET',
        'response' => 200,
        'body' => '{"message": "success"}',
    ]);

    $response = getJson('http://apinotready.localhost/api/abc/test');

    $response->assertStatus(200);
    $response->assertExactJson([
        'message' => 'success'
    ]);
});

it('loads proper data when called with user', function () {
    \Pest\Laravel\withoutExceptionHandling();
    factory(User::class)->create([
        'id' => 1,
    ]);
    factory(Endpoint::class)->create([
        'user_id' => 1,
        'endpoint' => '/abc/test',
        'method' => 'GET',
        'response' => 200,
        'body' => '{"message": "success"}',
    ]);

    $response = getJson('http://45EG523LPK.apinotready.localhost/abc/test');

    $response->assertStatus(200);
    $response->assertExactJson([
        'message' => 'success'
    ]);
});
