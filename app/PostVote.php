<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class PostVote extends Model
{
    protected $fillable = ['user_id', 'post_id', 'vote'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
