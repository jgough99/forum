@extends('layouts.app')

@section('title')
<p>{{$topic->title}}</p>
@endsection


@section('content')
    
    <ul>
        @foreach ($threads as $thread)
        <li><a href="{{route ('posts.index', ['thread_id' => $thread->id,'thread_title' => $thread->title]) }}">{{$thread->title}}</a></li>
        @endforeach
    </ul>

    <a href="{{route ('thread.create', ['topic_id' => $topic->id]) }}">Create new thread</a>

    <a href="{{route ('topics.index') }}">back</a>
@endsection