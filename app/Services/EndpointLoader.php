<?php

namespace App\Services;

use App\Models\Endpoint;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EndpointLoader
{
    /**
     * @param User $user
     * @param array $segments
     * @param string $method
     * @return Endpoint
     * @throws \Throwable
     */
    public function load(User $user, array $segments, string $method): Endpoint
    {
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
     * @throws \Throwable
     */
    private function getFromUser(User $user, array $segments, string $method): Endpoint
    {
        $endpoints = $user->endpoints()
            ->where('segments', implode('/', $segments))
            ->get();

        throw_if($endpoints->isEmpty(), NotFoundHttpException::class);

        $hasMethod = (bool) $endpoints->where('method', $method)->count();

        throw_unless($hasMethod, MethodNotAllowedHttpException::class);

        return $endpoints->first();
    }

    /**
     * @param array $segments
     * @param string $method
     * @return Endpoint
     * @throws \Throwable
     */
    private function get(array $segments, string $method): Endpoint
    {
        /** @var Endpoint $endpoint */
        $endpoint = Endpoint::findByHashOrFail(array_shift($segments));

        throw_unless($endpoint->method === $method, MethodNotAllowedHttpException::class);

        return $endpoint;
    }
}
