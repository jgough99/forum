@extends ('layouts.app')

@section ('title', 'Create Post')

@section ('content')
    <form method="POST"  enctype="multipart/form-data" action="{{route('user.store')}}">
        @csrf
            
        <select name="user_id">
        @foreach($users as $user)
            <option value="{{$user->id}}">
                {{$user->email}}
            </option>
        @endforeach
        </select>


        <input type="submit" value="Submit">

    </form>
@endsection