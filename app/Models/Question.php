<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['post_id', 'content', 'answers', 'parent_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
