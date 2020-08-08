<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EndpointLoader;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EndpointController
{
    /** @var EndpointLoader */
    private $endpointLoader;

    /**
     * EndpointController constructor.
     * @param EndpointLoader $endpointLoader
     */
    public function __construct(EndpointLoader $endpointLoader)
    {
        $this->endpointLoader = $endpointLoader;
    }

    /**
     * @param User $user
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(User $user, Request $request): JsonResponse
    {
        $endpoint = $this->endpointLoader->load($user, $request->segments(), $request->method());

        return response()->json(
            $endpoint->activeResponse->body,
            $endpoint->activeResponse->code
        );
    }
}
