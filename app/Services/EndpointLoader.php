<?php

namespace App\Services;

use App\Models\Endpoint;
use App\Models\User;
use Illuminate\Support\Collection;

class EndpointLoader
{
    /**
     * @param User $user
     * @param array $segments
     * @param string $method
     * @return Endpoint
     */
    public function load(User $user, array $segments, string $method): Endpoint
    {
        abort_unless($segments[0], 400, 'Invalid Url');

        if ($user->exists) {
            return $this->getFromUser($user, $segments, $method);
        }

        return $this->get($segments, $method);
    }

    /**
     * @param User $user
     * @param array $segments
     * @param string $method
     * @return Endpoint
     */
    private function getFromUser(User $user, array $segments, string $method): Endpoint
    {
        $endpoints = $user->endpoints()
            ->where('segments', implode('/', $segments))
            ->get();

        abort_if($endpoints->isEmpty(), 404, 'Endpoint not found');

        $hasMethod = (bool) $endpoints->where('method', $method)->count();

        abort_unless($hasMethod, 405, 'Invalid method');

        return $endpoints->first();
    }

    /**
     * @param array $segments
     * @param string $method
     * @return Endpoint
     */
    private function get(array $segments, string $method): Endpoint
    {
        /** @var Endpoint $endpoint */
        $endpoint = Endpoint::findByHashOrFail(array_shift($segments));

        abort_unless($endpoint->method === $method, 405, 'Invalid method');

        return $endpoint;
    }
}
