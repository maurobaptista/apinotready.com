<?php

namespace App\Models;

use App\Models\Traits\Hasheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class Endpoint
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property string $segments
 * @property string $method
 *
 * @property Collection $responses
 * @property Response $activeResponse
 * @property User|null $user
 * @property string $url
 * @property string $hash
 */
class Endpoint extends Model
{
    use Hasheable;

    /** @var string[] */
    protected $fillable = [
        'user_id', 'segments', 'method',
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
     * @return HasMany
     */
    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    /**
     * @return Response
     */
    public function getActiveResponseAttribute(): ?Response
    {
        return $this->responses->firstWhere('active', true);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        $domain = $this->user_id === null
            ? config('endpoint.domain') . '/' . $this->hash
            : preg_replace('/{subdomain}/', $this->user->hash, config('endpoint.sub_domain'), 1);

        return  $domain . '/' . $this->segments;
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
    public function setSegmentsAttribute(string $value): void
    {
        $this->attributes['segments'] = trim($value, '/');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'hash' => $this->hash,
            'user' => optional($this->user)->hash,
            'segments' => $this->segments,
            'method' => $this->method,
            'code' => $this->activeResponse->code,
            'body' => $this->activeResponse->body,
            'url' => $this->url,
        ];
    }
}
