<?php

namespace App\Models\Traits;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Trait Hasheable
 * @package App\Models\Traits
 * @method Model|null findByHash(string $hash)
 * @method Model findByHashOrFail(string $hash)
 */
trait Hasheable
{
    /** @var int */
    protected $minHashLength = 10;

    /** @var string */
    protected $alphabet = 'ABCDEFGHJKLMNPQRSTUVXZYW23456789';

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed $value
     * @param  null  $field
     * @return Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $id = $this->hash()->decode(strtoupper($value));

        abort_if(empty($id), 400, 'Invalid url');

        /** @var Model|null $item */
        $item =  $this->find($id[0]);

        abort_if($item === null, 404, 'Item not found');

        return $item;
    }

    /**
     * @return mixed
     */
    public function hash()
    {
        return new Hashids(self::class, $this->minHashLength, $this->alphabet);
    }

    /**
     * @return string
     */
    public function getHashAttribute(): string
    {
        return $this->hash()->encode($this->id);
    }

    /**
     * @param  Builder $query
     * @param  string  $hash
     * @return Model|null
     */
    public function scopeFindByHash(Builder $query, string $hash): ?Model
    {
        $decodedIds = $this->hash()->decode($hash);

        abort_unless(isset($decodedIds[0]), 400, 'Failed to decode hash');

        /** @var Model|Collection|null $item */
        $item = $query->find($decodedIds[0]);

        return $item;
    }

    /**
     * @param Builder $query
     * @param string $hash
     * @return Model|null
     * @throws \Throwable
     */
    public function scopeFindByHashOrFail(Builder $query, string $hash): Model
    {
        $item = $query->findByHash($hash)->first();

        throw_if(
            $item === null,
            NotFoundHttpException::class
        );

        return $item;
    }
}
