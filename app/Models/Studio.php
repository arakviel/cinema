<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\StudioFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    /** @use HasFactory<StudioFactory> */
    use HasFactory, HasUlids;
}
