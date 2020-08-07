<?php

namespace App\Models;

use App\Models\Traits\Hasheable;
use Facades\App\Helpers\Endpoint as EndpointHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Response
 * @package App\Models
 *
 * @property int $code
 * @property array $body
 */
class Response extends Model
{
    use Hasheable;

    /** @var string[] */
    protected $fillable = [
        'endpoint_id', 'body', 'code', 'active',
    ];

    /** @var string[] */
    protected $casts = [
        'code' => 'int',
        'active' => 'boolean',
    ];

    /**
     * @return array
     */
    public function getBodyAttribute(string $value): array
    {
         return json_decode($value, true);
    }
}
