@extends('Layout.template')

@section('content')

    <div class="container">

        <div class="list-group">
            @foreach ($users as $user)
                <a href="{{url('/user/'.$user->id)}}" class="list-group-item list-group-item-action">{{ $user->name }}</a>
            @endforeach
        </div>
    </div>

@endsection
