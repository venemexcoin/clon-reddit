<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class PostsCommentsController extends Controller
{
    public function create(Request $request, $postId)
    {
        //alidar la data

        $this->validate($request, [

            'comment' => 'required'
        ]);


        //Persistir el comntario

        $comment = new Comment;

        $comment->text = $request->get('comment');

        $comment->post_id = $postId;

        $comment->user_id = \Auth::user()->id;

        $comment->save();

        //redirecionar a la publicación

        return redirect()->route('post_path', ['post' => $postId]);
    }
}
