<?php

namespace App\Models;

use App\Models\Traits\Hasheable;
use Facades\App\Helpers\Endpoint as EndpointHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endpoint extends Model
{
    use Hasheable;

    /** @var string[] */
    protected $fillable = [
        'user_id', 'endpoint', 'method', 'response', 'body',
    ];

    /** @var string[] */
    protected $appends = [
        'hash', 'url',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return array|null
     */
    public function getBodyAsArrayAttribute(): ?array
    {
        return json_decode($this->body, true);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        $domain = $this->user_id === null
            ? config('endpoint.domain')
            : preg_replace('/{subdomain}/', $this->user->hash, config('endpoint.sub_domain'), 1);

        return  $domain . $this->endpoint;
    }

    /**
     * @param string $value
     */
    public function setMethodAttribute(string $value): void
    {
        $this->attributes['method'] = strtoupper($value);
    }

    /**
     * @param string $value
     */
    public function setEndpointAttribute($value): void
    {
        $this->attributes['endpoint'] = EndpointHelper::treat($value, request()->email === null);
    }
}
