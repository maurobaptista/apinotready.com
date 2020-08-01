<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endpoint extends Model
{
    /** @var string[] */
    protected $fillable = [
        'user_id', 'endpoint', 'method', 'response', 'body',
    ];
}
