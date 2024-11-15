<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\RatingFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperRating
 */
class Rating extends Model
{
    /** @use HasFactory<RatingFactory> */
    use HasFactory, HasUlids;
}
