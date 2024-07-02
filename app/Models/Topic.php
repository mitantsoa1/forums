<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;

    /**
     * Get the comments for the blog topic.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
