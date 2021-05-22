<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinGroup extends Model
{
    protected $table = "join_group";

    protected $fillable = ['user_id', 'group_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}