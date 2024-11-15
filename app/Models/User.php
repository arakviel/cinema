<?php

namespace Liamtseva\Cinema\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Liamtseva\Cinema\Enums\Gender;
use Liamtseva\Cinema\Enums\Role;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasUlids, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'role' => Role::class,
        'gender' => Gender::class,
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
        'password' => 'hashed',
    ];

    public function scopeAllowedAdults(Builder $query): Builder
    {
        return $query->where('allow_adult', true);
    }

    public function scopeByRole(Builder $query, Role $role): Builder
    {
        return $query->where('role', $role->value);
    }

    // TODO: отримати реальний шлях до картинки
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? url("storage/$value") : null
        );
    }
}
