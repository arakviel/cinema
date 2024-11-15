<?php

namespace Liamtseva\Cinema\Models;

use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperComment
 */
class Comment extends Model
{
    /** @use HasFactory<CommentFactory> */
    use HasFactory, HasUlids;
}
