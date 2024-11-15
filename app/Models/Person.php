<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\PersonFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Liamtseva\Cinema\Enums\Gender;
use Liamtseva\Cinema\Enums\PersonType;
use Liamtseva\Cinema\Models\Traits\HasSeo;

/**
 * @mixin IdeHelperPerson
 */
class Person extends Model
{
    /** @use HasFactory<PersonFactory> */
    use HasFactory, HasSeo, HasUlids;

    protected $guarded = [];

    protected $casts = [
        'type' => PersonType::class,
        'gender' => Gender::class,
        'birthday' => 'date',
    ];

    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    // TODO: fulltext
    public function scopeByName(Builder $query, string $name): Builder
    {
        return $query->where('name', 'like', '%'.$name.'%');
    }

    public function scopeByGender(Builder $query, string $gender): Builder
    {
        return $query->where('gender', $gender);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->original_name
                ? "{$this->name} ({$this->original_name})"
                : $this->name,
        );
    }

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->birthday
                ? now()->diffInYears($this->birthday)
                : null,
        );
    }
}
