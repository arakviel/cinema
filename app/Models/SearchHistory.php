<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\SearchHistoryFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSearchHistory
 */
class SearchHistory extends Model
{
    /** @use HasFactory<SearchHistoryFactory> */
    use HasFactory, HasUlids;
}
