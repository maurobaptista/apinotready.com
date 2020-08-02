<?php

namespace App\Http\Controllers\Endpoint;

use App\Http\Requests\Endpoint\StoreRequest;
use App\Models\Endpoint;
use App\Models\User;
use Facades\App\Helpers\Endpoint as EndpointHelper;
use Illuminate\Http\JsonResponse;

class StoreController
{
    /** @var Endpoint */
    private $endpoint;

    /** @var User */
    private $user;

    /**
     * StoreController constructor.
     * @param Endpoint $endpoint
     * @param User $user
     */
    public function __construct(Endpoint $endpoint, User $user)
    {
        $this->endpoint = $endpoint;
        $this->user = $user;
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function __invoke(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (! empty($request->email)) {
            $user = $this->user->firstOrCreate(['email' => $request->email]);

            $data = array_merge($data, [
                'user_id' => $user->id,
            ]);
        }

        $data['endpoint'] = EndpointHelper::treat($request->endpoint, $request->email === null);

        $endpoint = $this->endpoint->create($data);

        return response()->json(
            $endpoint->only('hash', 'method', 'response', 'body', 'url'),
            201
        );
    }
}
