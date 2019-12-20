@extends ('layouts.app')

@section ('title', 'Create Post')

@section ('content')
    <form method="POST"  enctype="multipart/form-data" action="{{route('user.store')}}">
        @csrf
            
        <select class="custom-select" name="user_id">
        @foreach($users as $user)
            <option value="{{$user->id}}">
                {{$user->email}}
            </option>
        @endforeach
        </select>
        <br>
        <br>
        <input class="btn btn-primary" type="submit" value="Submit">

    </form>
@endsection