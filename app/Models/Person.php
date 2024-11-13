<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\PersonFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /** @use HasFactory<PersonFactory> */
    use HasFactory, HasUlids;
}
