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

    public function getRouteKeyName(): string
    {
        // Pour afficher dans l'url au lieu de 'id' lorqu'on affiche un post 
        return 'slug';
    }


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}