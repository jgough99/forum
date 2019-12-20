@extends ('layouts.app')

@section ('title', 'Edit Post')


<!-- Get inputs from a user to edit a post -->
@section ('content')
    <form method="POST" action="{{route('post.update',['post_id'=>$post->id])}}">
        @csrf
       
        <p>Content: <input type="text" name="content"
            value="{{$post->content}}"></p>

        <input  class="btn btn-primary" type="submit" value="Submit">

    </form>
@endsection