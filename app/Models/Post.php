<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['author', 'title', 'description', 'respondent', 'slug', 'status'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
