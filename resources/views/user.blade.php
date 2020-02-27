@extends('Layout.template')

@section('content')

    <div class="container">

        <div class="row my-2">
            <div class="col-lg-8 order-lg-2">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Videos</a>
                    </li>
                    @auth
                        @if(Auth::user()->id == $user->id)
                    <li class="nav-item">
                        <a href="" data-target="#your" data-toggle="tab" class="nav-link">Own comments</a>
                    </li>
                        @endif
                    @endauth
                </ul>
                <div class="tab-content py-4">
                    <div class="tab-pane active" id="profile">
                        <h4 class="mb-3">{{$user->name}} {{$user->surname}}</h4>
                        <h5 class="mb-3">{{$user->email}}</h5>
                        <!--/row-->
                    </div>
                    <div class="tab-pane" id="messages">
                        @auth
                            @if(Auth::user()->id != $user->id)
                                <a href="{{url('/comment/user/new/'.$user->id)}}" class="btn btn-primary mb-1">New comment</a>
                            @endif
                        @endauth

                        <table class="table table-hover table-striped">
                            <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>
                                    <p class="float-right font-weight-bold">
                                        @auth
                                            @if(Auth::user()->id == $comment->user_id)
                                        <a href="{{url('/comment/edit/'.$comment->id)}}" class="btn btn-secondary">Edit</a>
                                        <a href="{{url('/comment/delete/'.$comment->id)}}" class="btn btn-danger">Delete</a></p>
                                            @endif
                                        @endauth
                                    {{$comment->body}}
                                    <p><small>{{$comment->user->name}}</small></p>
                                    <p><small>{{$comment->created_at->diffForHumans()}}</small></p>
                                </td>
                            </tr>
                        @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="edit">
                        @auth
                            @if(Auth::user()->id == $user->id)
                        <a href="{{url('/video/new')}}" class="btn btn-primary mb-5">Upload Video</a>
                            @endif
                        @endauth
                            <div class="row">

                                @if (count($videos) > 0)

                                    @foreach ($videos as $video)
                                        <div class="card col-5" >
                                            <img class="card-img-top" src="{{ route('getThumb', $video->id)  }}" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $video->title }}</h5>
                                                <p class="card-text">{{ $video->description }}</p>
                                                <a href="{{url('/video/'.$video->id)}}" class="btn btn-primary ">View</a>
                                                @auth
                                                    @if(Auth::user()->id == $user->id)
                                                <a href="{{url('/video/edit/'.$video->id)}}" class="btn btn-secondary">Edit</a>
                                                <a href="{{url('/video/delete/'.$video->id)}}" class="btn btn-danger">Delete</a>
                                                    @endif
                                                    @endauth
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h5>No videos uploaded</h5>
                                @endif


                            </div>
                    </div>

                    @auth
                        @if(Auth::user()->id == $user->id)

                    <div class="tab-pane" id="your">
                        @if (count($ownComments) > 0)
                            <table class="table table-hover table-striped">
                                <tbody>
                                @foreach ($ownComments as $ownComment)
                                    <tr>
                                        <td>
                                            <p class="float-right font-weight-bold">
                                                <a href="{{url('/comment/edit/'.$ownComment->id)}}" class="btn btn-secondary">Edit</a>
                                                <a href="{{url('/comment/delete/'.$ownComment->id)}}" class="btn btn-danger">Delete</a></p>
                                            {{$ownComment->body}}
                                            <p><small>{{$ownComment->user->name}}</small></p>
                                            <p><small>{{$ownComment->created_at->diffForHumans()}}</small></p>

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @else
                            <h4>No comments found</h4>
                        @endif
                    </div>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="col-lg-4 order-lg-1 text-center">
                <img src="{{ route('getAvatar', $user->id)  }}" class="mx-auto img-fluid img-circle d-block" alt="avatar">
                @auth
                    @if(Auth::user()->id == $user->id)
                        <a href="{{url('/user/edit/'.$user->id)}}" class="btn btn-primary mt-3">Edit user</a>
                @endif
            @endauth

            </div>
        </div>
    </div>

@endsection
