@extends ('layouts.app')

@section ('title', 'Create Post')

<!-- Get inputs from user to create new post -->

@section ('content')
    <form method="POST"  enctype="multipart/form-data" action="{{route('post.store',['parent_post_id'=>$post->id])}}">
        @csrf

        <p>Content: <input  class="form-control" type="text" name="content"
            value="{{old('content')}}"></p>
        <div class="form-control-file">
         <input class="form-control-file" id="image" type="file" class="form-control" name="image">
        </div>
        <br>
        <input  class="btn btn-primary" type="submit" value="Submit">

    </form>
@endsection