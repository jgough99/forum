

@foreach($replies as $reply)
        <ul  style="list-style: none;">
            <li class="jumbotron">
            <img class="user_avatar" src="/storage/{{ $reply->image }}" />
            <br>
            {{$reply->content}} <b>posted by {{$reply->user->userProfile->name}}</b>
            
            @if (Auth::check())
            <a href="{{route ('post.create', ['parent_post_id' => $reply->id]) }}"> reply</a>

            @if ($reply->user->id == Auth::user()->id)
            <a href="{{route ('post.edit', ['post_id' => $reply->id]) }}"> edit</a>
            <form method="POST"
                action="{{route('post.delete',['post_id' => $reply->id])}}">
                @csrf
                @method('DELETE')
                <button class="btn btn-primary" type="submit">delete</button>
            </form>
            @endif
            @endif
           
            
            </li> 
           
	    @if(count($reply->replies))
            @include('posts.reply',['replies' => $reply->replies])
        @endif
        </ul> 
@endforeach