<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostVote;

class PostVotesController extends Controller
{
    public function store(Request $request, $postId)
    {


        $vote = (int) $request->get('vote');

        $userId = \Auth::user()->id;

        // revisar  si ya existe un voto para estepost por el usuario

        $postVote = PostVote::firstOrNew(['user_id' => $userId, 'post_id' => $postId]);

        // si no existe creamos el voto

        if (!$postVote->exists) {
            $postVote->vote = $vote;
            $postVote->save();
        } else {
            // si existe, actualizar el voto anterior

            PostVote::where(['user_id' => $userId, 'post_id' => $postId])->update(['vote' => $vote]);
        }

        $post = $postVote->post;

        return response()->json(['vote_total' => $post->totalVotes()]);
    }
}
