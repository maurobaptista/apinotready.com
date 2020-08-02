<?php

namespace App\Http\Controllers\Endpoint;

class CreateController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return view('endpoints.create');
    }
}
