@extends('layouts.app')

@section('title')
<p>All Post</p>
@endsection

<!-- Display all posts indentated, if the post has a reply recursively make a new list inside the list of the child posts -->

@section('content')

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/twitter-bootstrap/3.0.3/css/bootstrap-combined.min.css">

<h1>Posts in {{$posts->first()->thread->title}}</h1>
    @foreach($posts as $post)
        <ul style="padding-left: 0; list-style: none;"}>
            <li class="jumbotron">{{$post->content}} <b>posted by {{$post->user->userProfile->name}}</b>
            @if (Auth::check())
            
                <a href="{{route ('post.create', ['parent_post_id' => $post->id]) }}"> reply</a>
               
            @endif

            @if ($post->user == Auth::user())
            <a href="{{route ('post.edit', ['post_id' => $post->id]) }}"> edit</a>
            <form method="POST"
                action="{{route('post.delete',['post_id' => $post->id])}}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
            @endif
            </li>
            
            @if(count($post->replies))
                @include('posts.reply',['replies' => $post->replies])
            @endif 
        </ul>
        
    @endforeach
    <a href="{{route ('threads.index',['topic_id' => $posts->first()->thread->topic->id, 'topic_title' => $posts->first()->thread->topic->title] )}}">back</a>

   
   

@endsection