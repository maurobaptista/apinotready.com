<?php

namespace App\Observers;

use App\Models\Endpoint;

class EndpointObserver
{
    /**
     * Handle the endpoint "created" event.
     *
     * @param Endpoint $endpoint
     * @return void
     */
    public function created(Endpoint $endpoint)
    {
        // Don't prepend endpoint if it is from an user
        if ($endpoint->user_id !== null) {
            return;
        }

        Endpoint::withoutEvents(function () use ($endpoint) {
            $endpoint->segments = vsprintf('/%s/%s/', [
                $endpoint->hash,
                trim($endpoint->segments, '/'),
            ]);
            $endpoint->save();
        });
    }
}
