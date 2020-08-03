<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Endpoint;
use Faker\Generator as Faker;

$factory->define(Endpoint::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(\App\Models\User::class)->create()->id;
        },
        'segments' => '/test',
        'method' => 'POST',
        'response' => 201,
        'body' => '{"message": "success"}',
    ];
});
