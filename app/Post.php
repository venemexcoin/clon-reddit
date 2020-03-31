<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\PostVote;
use App\Comment;
use App\User;



class Post extends Model
{
    protected $table = 'posts';

    protected $casts = ['user_id' => 'integer'];

    protected $fillable = ['title', 'description', 'url'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->hasMany(PostVote::class);
    }



    public function userVote(?User $user)
    {

        if (!$user) {
            return 0;
        }

        $vote = $this->votes->first(function ($vote) use ($user) {

            return $vote->user_id === $user->id;
        });

        if (!$vote) {
            return 0;
        }

        return $vote->vote;
    }

    public function wasCreteatedBy($user)
    {
        if (is_null($user)) {
            return false;
        }

        return  $this->user_id === $user->id;
    }
    public function totalVotes()
    {
        return $this->votes()->sum('vote');
    }
}
