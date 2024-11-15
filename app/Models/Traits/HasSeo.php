<?php

namespace Liamtseva\Cinema\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasSeo
{
    public function scopeBySlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    protected function metaMetaImage(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? url("storage/$value") : null
        );
    }
}
