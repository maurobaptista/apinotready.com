<?php

use App\Models\Endpoint;
use App\Models\Response;
use App\Models\User;

use function Pest\Laravel\{getJson};

it('loads proper data when called with no user', function () {
    factory(Endpoint::class)->create([
        'id' => 1,
        'user_id' => null,
        'segments' => '/abc/test',
        'method' => 'GET',
    ]);
    factory(Response::class)->state('active')->create([
        'endpoint_id' => 1,
        'code' => 200,
        'body' => '{"message": "success"}',
    ]);

    $response = getJson('http://api.apinotready.localhost/DJ4MZ3LZ8K/abc/test');

    $response->assertStatus(200);
    $response->assertExactJson([
        'message' => 'success'
    ]);
});

it('loads proper data when called with user', function () {
    factory(User::class)->create([
        'id' => 1,
    ]);
    factory(Endpoint::class)->create([
        'id' => 1,
        'user_id' => 1,
        'segments' => '/abc/test',
        'method' => 'GET',
    ]);
    factory(Response::class)->state('active')->create([
        'endpoint_id' => 1,
        'code' => 200,
        'body' => '{"message": "success"}',
    ]);

    $response = getJson('http://45EG523LPK.apinotready.localhost/abc/test');

    $response->assertStatus(200);
    $response->assertExactJson([
        'message' => 'success'
    ]);
});
