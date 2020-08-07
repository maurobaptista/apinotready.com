<?php

namespace App\Services;

use App\Models\Endpoint;
use App\Models\User;

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
        /** @var Endpoint|null $endpoint */
        $endpoint = $user->endpoints()
            ->where('segments', implode('/', $segments))
            ->first();

        abort_if($endpoint === null, 404, 'Endpoint not found');

        $hasMethod = (bool) $endpoint->where('method', $method)->count();

        abort_unless($hasMethod, 405, 'Invalid method');

        return $endpoint;
    }

    /**
     * @param array $segments
     * @param string $method
     * @return Endpoint
     */
    private function get(array $segments, string $method): Endpoint
    {
        /** @var Endpoint|null $endpoint */
        $endpoint = Endpoint::findByHash(array_shift($segments));

        abort_if($endpoint === null, 404, 'Endpoint not found');
        abort_unless($endpoint->method === $method, 405, 'Invalid method');

        return $endpoint;
    }
}
