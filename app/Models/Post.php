<?php

namespace App\Models;

use App\Models\User;
use App\Models\Topic;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'title', 'content', 'user_id', 'topic_id', 'created_at', 'updated_at'];

    protected $with = [
        'topic',
    ];

    public function getRouteKeyName(): string
    {
        // Pour afficher dans l'url au lieu de 'id' lorqu'on affiche un post 
        return 'slug';
    }
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
