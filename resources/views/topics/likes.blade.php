@extends('layouts.app')

@section('title')
@endsection

<!-- Showing all the topics the user has liked -->

@section('content')
    <h1>Liked Topics:</h1>
    <ul   style="padding-left: 0; list-style: none;"}>
    
        @foreach ($likedTopics as $topic)
        
        
            <li>
                
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$topic->title}}</h5>
               
                <a href="{{route ('threads.index', ['topic_id' => $topic->id,'topic_title' => $topic->title]) }}">View Topic</a>
            </div>
            </div>
            <br>
                
            </li>
        
        @endforeach
    </ul>

@endsection