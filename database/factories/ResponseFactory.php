<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Response;
use Faker\Generator as Faker;

$factory->define(Response::class, function (Faker $faker) {
    return [
        'active' => false,
        'code' => 201,
        'body' => '{"message": "success"}',
    ];
});

$factory->state(Response::class, 'active', function ($faker) {
    return [
        'active' => true,
    ];
});

$factory->state(Response::class, 'inactive', function ($faker) {
    return [
        'active' => false,
    ];
});
