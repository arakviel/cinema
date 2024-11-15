<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\StudioFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Liamtseva\Cinema\Models\Traits\HasSeo;

/**
 * @mixin IdeHelperStudio
 */
class Studio extends Model
{
    /** @use HasFactory<StudioFactory> */
    use HasFactory, HasSeo, HasUlids;

    protected $guarded = [];

    // TODO: fulltext search

    public function scopeByName(Builder $query, string $name): Builder
    {
        return $query->where('name', 'like', '%'.$name.'%');
    }
}
