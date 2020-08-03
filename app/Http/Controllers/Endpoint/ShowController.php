<?php

namespace App\Http\Controllers\Endpoint;

use App\Models\Endpoint;
use App\Models\User;
use Facades\App\Helpers\Endpoint as EndpointHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShowController
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
     * @param User $user
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(User $user, Request $request): JsonResponse
    {
        $url = Str::after($request->url(), config('app.domain'));
        $segments = ($user->exists)
            ? $url
            : preg_replace('/\/api/', '', $url, 1);

        $model = $this->endpoint->query()
            ->where('user_id', $user->id)
            ->where('method', $request->method())
            ->where('segments', trim($segments, '/'))
            ->first();

        return response()->json($model->bodyAsArray, $model->response);
    }
}
