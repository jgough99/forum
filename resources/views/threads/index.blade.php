@extends('layouts.app')

@section('title')
<p>{{$topic->title}}</p>
@endsection

<!-- Show all threads in a topic -->

@section('content')
    <h1>Threads in {{$topic->title}}</h1>
    <ul   style="padding-left: 0; list-style: none;"}>
    @if (Auth::check())
    @if(!Auth::user()->likedTopics->contains($topic->id))
        <a href="{{route ('topic.like', ['topic_id' => $topic->id]) }}" ><button class="btn btn-warning">Like {{$topic->title}}</button></a>
        <br>
        <br>
    @endif
    @endif

        @foreach ($threads as $thread)
        
        
            <li>
                
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$thread->title}}</h5>
                <a href="{{route ('posts.index', ['thread_id' => $thread->id,'thread_title' => $thread->title]) }}">View Thread</a>
                @if (Auth::check())
                @if ($thread->creator_id == Auth::user()->id)
                <form method="POST"
                action="{{route('thread.delete',['thread_id' => $thread->id])}}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
                @endif
                @endif
            </form>
            </div>
            </div>
            <br>
                
            </li>
        
        @endforeach
    </ul>
    <span>{{$threads->links()}}</span>
    @if(auth::check())
    <a href="{{route ('thread.create', ['topic_id' => $topic->id]) }}"><button class="btn btn-primary">Create new thread</button></a>
    @endif
    <a href="{{route ('topics.index') }}">back</a>
@endsection