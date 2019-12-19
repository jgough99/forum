@extends('layouts.app')

@section('title')
<p>{{$topic->title}}</p>
@endsection


@section('content')
    <h1>Threads in {{$topic->title}}</h1>
    <ul   style="padding-left: 0; list-style: none;"}>
    
        @foreach ($threads as $thread)
        
        
            <li>
                
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$thread->title}}</h5>
               
                <a href="{{route ('posts.index', ['thread_id' => $thread->id,'thread_title' => $thread->title]) }}">View Thread</a>
            </div>
            </div>
            <br>
                
            </li>
        
        @endforeach
    </ul>

    <a href="{{route ('thread.create', ['topic_id' => $topic->id]) }}">Create new thread</a>

    <a href="{{route ('topics.index') }}">back</a>
@endsection