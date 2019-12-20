@extends ('layouts.app')

@section ('title', 'Create Thread')

<!-- Getting user input in order to make a thread -->

@section ('content')
    <form method="POST" action="{{route('thread.store',['topic_id'=>$topic->id])}}">
        @csrf
       
        <p>Title: <input class="form-control" type="text" name="title"
            value="{{old('title')}}"></p>

        <p>Content: <input class="form-control" type="text" name="content"
            value="{{old('content')}}"></p>


        <input  class="btn btn-primary" type="submit" value="Submit">

    </form>
@endsection