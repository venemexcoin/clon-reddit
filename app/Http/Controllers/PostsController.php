<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdataPostRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user', 'votes')->orderBy('id', 'desc')->paginate(10);

        return view('posts.index')->with(['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = new Post;

        $post->fill(

            $request->only('title', 'description', 'url')

        );

        $post->user_id = auth()->user()->id;

        $post->save();

        session()->flash('message', 'Post Created!');

        return redirect()->route('posts_path');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->load(['comments' => function ($query) {
            $query->orderBy('id', 'desc');
        }, 'comments.user']);

        //dd($post);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        if ($post->user_id != \Auth::user()->id) {
            return redirect()->route('posts_path');
        }

        return view('/posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, UpdataPostRequest $request)
    {

        $post->update(
            $request->only('title', 'description', 'url')
        );

        session()->flash('message', 'Post Update!');

        return redirect()->route('post_path', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Post $post)
    {
        if ($post->user_id != \Auth::user()->id) {
            return redirect()->route('posts_path');
        }
        $post->delete();

        session()->flash('message1', 'Post Delete!');

        return redirect()->route('posts_path');
    }
}
