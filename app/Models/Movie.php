<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\MovieFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperMovie
 */
class Movie extends Model
{
    /** @use HasFactory<MovieFactory> */
    use HasFactory, HasUlids;
}
