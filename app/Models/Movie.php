<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\MovieFactory;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Liamtseva\Cinema\Casts\ApiSourcesCast;
use Liamtseva\Cinema\Casts\AttachmentsCast;
use Liamtseva\Cinema\Casts\MovieRelateCast;
use Liamtseva\Cinema\Enums\Country;
use Liamtseva\Cinema\Enums\Kind;
use Liamtseva\Cinema\Enums\Period;
use Liamtseva\Cinema\Enums\RestrictedRating;
use Liamtseva\Cinema\Enums\Source;
use Liamtseva\Cinema\Enums\Status;
use Liamtseva\Cinema\Enums\VideoQuality;
use Liamtseva\Cinema\Models\Scopes\PublishedScope;
use Liamtseva\Cinema\Models\Traits\HasSeo;

/**
 * @mixin IdeHelperMovie
 */
#[ScopedBy([PublishedScope::class])]
class Movie extends Model
{
    /** @use HasFactory<MovieFactory> */
    use HasFactory, HasSeo, HasUlids;

    protected $guarded = [];

    // Фільтрує за типом (Kind)
    public function scopeOfKind(Builder $query, Kind $kind): Builder
    {
        return $query->where('kind', $kind->value);
    }

    public function scopeWithStatus(Builder $query, Status $status): Builder
    {
        return $query->where('status', $status->value);
    }

    public function scopeOfPeriod(Builder $query, Period $period): Builder
    {
        return $query->where('period', $period->value);
    }

    public function scopeWithRestrictedRating(Builder $query, RestrictedRating $restrictedRating): Builder
    {
        return $query->where('restricted_rating', $restrictedRating->value);
    }

    public function scopeFromSource(Builder $query, Source $source): Builder
    {
        return $query->where('source', $source->value);
    }

    public function scopeWithVideoQuality(Builder $query, VideoQuality $videoQuality): Builder
    {
        return $query->where('video_quality', $videoQuality->value);
    }

    public function scopeWithImdbScoreGreaterThan(Builder $query, float $score): Builder
    {
        return $query->where('imdb_score', '>=', $score);
    }

    public function scopeFromCountry(Builder $query, Country $country): Builder
    {
        return $query->whereJsonContains('countries', $country->value);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class)->chaperone();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function persons(): BelongsToMany
    {
        return $this->belongsToMany(Person::class)
            ->withPivot('character_name');
    }

    // TODO: продумати, де зберігати картинки...
    public function userNotifications(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'movie_user_notifications')
            ->as('notification')
            ->withTimestamps();
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class)->chaperone();
    }

    public function userLists(): MorphMany
    {
        return $this->morphMany(UserList::class, 'listable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function selections(): MorphToMany
    {
        return $this->morphToMany(Selection::class, 'selectionable');
    }

    protected function posterUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->poster ? asset("storage/$this->poster") : null
        );
    }

    protected function casts(): array
    {
        return [
            'aliases' => AsCollection::class,
            'countries' => AsEnumCollection::of(Country::class),
            'attachments' => AttachmentsCast::class,
            'related' => MovieRelateCast::class,
            'similars' => AsCollection::class,
            'imdb_score' => 'float',
            'first_air_date' => 'date',
            'last_air_date' => 'date',
            'api_sources' => ApiSourcesCast::class,
            'kind' => Kind::class,
            'status' => Status::class,
            'period' => Period::class,
            'restricted_rating' => RestrictedRating::class,
            'source' => Source::class,
            'video_quality' => VideoQuality::class,
        ];
    }
}
