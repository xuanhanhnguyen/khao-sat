<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Result extends Model
{
    protected $table = 'results';
    protected $fillable = ['user_id', 'post_id', 'results'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function hasPost()
    {
        return $this->post()->where('author', Auth::id());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
