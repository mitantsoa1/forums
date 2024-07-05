<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reaction_jmp extends Model
{
    use HasFactory;

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
