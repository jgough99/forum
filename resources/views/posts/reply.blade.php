@foreach($replies as $reply)
        <ul>
            <li>{{$reply->content}} <b>posted by {{$reply->user->userProfile->name}}</b>
            <a href="{{route ('post.create', ['parent_post_id' => $reply->id]) }}"> reply</a>
            <a href="{{route ('post.edit', ['post_id' => $reply->id]) }}"> edit</a>
            <form method="POST"
                action="{{route('post.delete',['post_id' => $reply->id])}}">
                @csrf
                @method('DELETE')
                <button type="submit">delete</button>
            </form>
            </li> 
        
	    @if(count($reply->replies))
            @include('posts.reply',['replies' => $reply->replies])
        @endif
        </ul> 
@endforeach