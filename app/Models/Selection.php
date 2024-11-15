<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\SelectionFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSelection
 */
class Selection extends Model
{
    /** @use HasFactory<SelectionFactory> */
    use HasFactory, HasUlids;
    
}
