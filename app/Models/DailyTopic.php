<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class DailyTopic extends Model {
    protected $fillable = ['topic'];

    public function likes()
{

    return $this->morphMany(Like::class, 'likeable');
}

public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}
}