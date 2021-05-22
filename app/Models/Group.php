<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{
    protected $table = "groups";

    protected $fillable = ['name', 'description', 'user_id', 'limit', 'status'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'join_group', 'group_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_group', 'group_id');
    }

    public function join()
    {
        return $this->hasMany(JoinGroup::class);
    }

    public function hasGroup()
    {
        return $this->join()->where('user_id', '=', Auth::id());
    }

    public function pheDuyetGroup()
    {
        return $this->hasGroup()->where('status', 1);
    }

    public function moreGroup()
    {
        return $this->join()->where('user_id', '<>', Auth::id());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}