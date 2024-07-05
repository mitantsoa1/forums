<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Reaction_jm;
use App\Models\Reaction_jmp;
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

    // public function reaction_jms()
    // {
    //     return $this->hasMany(Reaction_jm::class);
    // }

    // public function reaction_jmps()
    // {
    //     return $this->hasMany(Reaction_jmp::class);
    // }

    // public function reaction_jmsCount()
    // {
    //     return $this->reaction_jms()
    //         ->selectRaw('comment_id, SUM(jm) as total_jm')
    //         ->groupBy('comment_id');
    // }

    // public function reaction_jmpsCount()
    // {
    //     return $this->reaction_jmps()
    //         ->selectRaw('comment_id, SUM(jmp) as total_jmp')
    //         ->groupBy('comment_id');
    // }
}