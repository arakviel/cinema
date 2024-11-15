<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Liamtseva\Cinema\Models\Traits\HasSeo;

/**
 * @mixin IdeHelperTag
 */
class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use HasFactory, HasSeo, HasUlids;

    protected $guarded = [];

    protected $casts = [
        'aliases' => 'array',
    ];

    public function scopeGenres($query)
    {
        return $query->where('is_genre', true);
    }

    // TODO: Переробити на fulltext
    public function scopeSearch($query, string $term)
    {
        return $query->where('name', 'LIKE', "%{$term}%")
            ->orWhere('slug', 'LIKE', "%{$term}%");
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? url("storage/$value") : null
        );
    }
}
