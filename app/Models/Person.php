<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\PersonFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
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

    public function scopeByType(Builder $query, PersonType $type): Builder
    {
        return $query->where('type', $type->value);
    }

    public function scopeByName(Builder $query, string $name): Builder
    {
        return $query->where('name', 'like', '%'.$name.'%');
    }

    // TODO: fulltext

    public function scopeByGender(Builder $query, string $gender): Builder
    {
        return $query->where('gender', $gender);
    }

    public function movies(): BelongsToMany
    {
        //return $this->belongsToMany(Movie::class, 'movie_person')
        return $this->belongsToMany(Movie::class)
            ->withPivot('character_name');
    }

    public function userLists(): MorphMany
    {
        return $this->morphMany(UserList::class, 'listable');
    }

    public function selections(): MorphToMany
    {
        return $this->morphToMany(Selection::class, 'selectionable');
    }

    protected function casts(): array
    {
        return [
            'type' => PersonType::class,
            'gender' => Gender::class,
            'birthday' => 'date',
        ];
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
