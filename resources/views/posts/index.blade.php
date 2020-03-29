@extends('layouts.app')

@section('content')

@foreach ($posts as $post)

<div class="row">

    <div class="col-md-1">

        <post-vote
        :post-id="{{ $post->id }}"

        :current-votes="{{ $post->totalVotes() }}"

        :user-vote="0"
        ></post-vote>
    </div>



    <div class="col-md-11">
    <h2>
        <a href="{{ route('post_path', ['post' => $post->id]) }}">{{$post->title}}</a>

        @if($post->wasCreteatedBy(Auth::user() ))

        <small class="float-right">
        <a href="{{ route('edit_post_path', ['post' => $post->id ]) }}" class="btn btn-info">Editar</a>

        <form action="{{ route('delete_post_path', ['post' => $post->id ]) }}" method="POST">
        @csrf
        {{ method_field('DELETE') }}

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>


        </form>
        </small>

        @endif
    </h2>
<p>Posted{{ $post->created_at->diffForHumans() }} by <b>{{ $post->user->name }}</b></p>
    </div>
</div>

@endforeach

{{ $posts->render() }}

@endsection


