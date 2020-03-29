@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">

    <h2>{{$post->title}}</h2>
    <p>{{$post->description}}</p>
        <p>Posted {{$post->created_at->diffForHumans()}}</p>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-12">


        <div class="row">
            <div class="col-md-12">
                @foreach ($post->comments as $comment)
                <div class="card">

                    {{ $comment->text }} <br>
                    {{$comment->user->name}}- {{ $comment->created_at->diffForHumans() }}
                </div>
                @endforeach
            </div>
        </div>


    </div>
</div>

<div class="row">
    <div class="col-md-12">


        @if(Auth::guest())

        Please log in to your account to comment.

        @else
    <form action="{{ route('create_comment_path', ['post' => $post->id ]) }}" method="POST">

        @csrf

        <div class="form-group">
            <label class="comment">Comment:</label>
            <textarea rows="5" name="comment" id="" class="form-control" ></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Post comment</button>
        </div>
       </form>
       @endif
    </div>
</div>


@endsection
