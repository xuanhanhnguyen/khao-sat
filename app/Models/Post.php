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

    public function checkQuestions()
    {
        return $this->questions()->where('status', 1);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'post_group', 'post_id');
    }
}
