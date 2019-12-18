@extends ('layouts.app')

@section ('title', 'Create Topic')

@section ('content')
    <form method="POST" action="{{route('topic.store')}}">
        @csrf
            
        <p>User ID: <input type="text" name="user_id"
            value="{{old('user_id')}}"></p>
       
        <p>Title: <input type="text" name="title"
            value="{{old('title')}}"></p>

            <p>Title: <input type="text" name="description"
            value="{{old('description')}}"></p>

        <input type="submit" value="Submit">

    </form>
@endsection