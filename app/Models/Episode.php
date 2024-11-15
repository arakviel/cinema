<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\EpisodeFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperEpisode
 */
class Episode extends Model
{
    /** @use HasFactory<EpisodeFactory> */
    use HasFactory, HasUlids;
}
