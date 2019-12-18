@extends('layouts.app')

@section('title')
<p>All Post</p>
@endsection


@section('content')

    @foreach($posts as $post)
        <ul>
            <li>{{$post->content}} <b>posted by {{$post->user->userProfile->name}}</b>
            <a href="{{route ('post.create', ['parent_post_id' => $post->id]) }}"> reply</a>
            <a href="{{route ('post.edit', ['post_id' => $post->id]) }}"> edit</a>
            <form method="POST"
                action="{{route('post.delete',['post_id' => $post->id])}}">
                @csrf
                @method('DELETE')
                <button type="submit">delete</button>
            </form>
            </li>
            <img src="public/storage/images/{{ $post->image }}" >
            @if(count($post->replies))
                @include('posts.reply',['replies' => $post->replies])
            @endif 
        </ul>
        
    @endforeach


   
   

@endsection