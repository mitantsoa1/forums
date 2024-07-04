<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $with = ['user'];

    protected $fillable = ['content', 'post_id', 'user_id'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the topic that owns the comment.
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function reactionsCount()
    {
        return $this->reactions()
            ->selectRaw('comment_id, SUM(jm) as total_jm, SUM(jmp) as total_jmp')
            ->groupBy('comment_id');
    }
}
