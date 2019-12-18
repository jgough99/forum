@extends ('layouts.app')

@section ('title', 'Edit Post')

@section ('content')
    <form method="POST" action="{{route('post.update',['post_id'=>$post->id])}}">
        @csrf
            
        <p>User ID: <input type="text" name="user_id"
            value="{{old('user_id')}}"></p>
       
        <p>Content: <input type="text" name="content"
            value="{{$post->content}}"></p>

        <input type="submit" value="Submit">

    </form>
@endsection