@extends ('layouts.app')

@section ('title', 'Create Topic')

<!-- Get user input to create a new topic -->

@section ('content')
    <form method="POST" action="{{route('topic.store')}}">
        @csrf
            
       
        <p>Title: <input class="form-control" type="text" name="title"
            value="{{old('title')}}"></p>

            <p>Content: <input class="form-control" type="text" name="description"
            value="{{old('description')}}"></p>

        <input class="btn btn-primary" type="submit" value="Submit">

    </form>
@endsection