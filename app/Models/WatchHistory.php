<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\WatchHistoryFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperWatchHistory
 */
class WatchHistory extends Model
{
    /** @use HasFactory<WatchHistoryFactory> */
    use HasFactory, HasUlids;
}
