<?php


namespace App\Helpers;


use Illuminate\Support\Str;

class Endpoint
{
    /**
     * @param string $endpoint
     * @param bool $shouldPrepend
     * @return string
     */
    public function treat(string $endpoint, bool $shouldPrepend): string
    {
        $prepend = ($shouldPrepend)
            ? Str::random(16) . '/'
            : '';

        return '/' . $prepend . trim($endpoint, '/');
    }

    /**
     * @param string $url
     * @param bool $fromUser
     * @return string
     */
    public function clean(string $url, bool $fromUser): string
    {
        $endpoint = Str::after($url, config('app.domain'));

        if (! $fromUser) {
            $endpoint = preg_replace('/\/api/', '', $endpoint, 1);
        }

        return $endpoint;
    }
}
