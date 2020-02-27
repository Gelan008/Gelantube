@extends('Layout.template')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6">
                <div align="center" class="embed-responsive embed-responsive-16by9">

                    <video class="embed-responsive-item" controls>
                        <source src="{{ route('getVideo', $video->id)  }}" type="video/{{pathinfo($video->video_path)['extension']}}">
                    </video>
                </div>
            </div>
            <div class="col-6">
                <h3>{{$video->title}}</h3>
                <p>{{$video->description}}</p>
                <p><small>{{$video->user->name}}</small></p>
                <p>{{$video->created_at->diffForHumans()}}</p>
            </div>

        </div>
        <div class="row mt-5">

            <div class="col-12">
                <h2>
                @auth
                <a class="btn btn-primary" href="{{url('/comment/video/new/'.$video->id)}}" role="button">New comment</a>
                @endauth
                    Comments</h2>
                <table class="table table-hover table-striped">
                    <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>
                                @auth
                                    @if(Auth::user()->id == $comment->user_id)
                                <p class="float-right font-weight-bold">
                                    <a href="{{url('/comment/edit/'.$comment->id)}}" class="btn btn-secondary">Edit</a>
                                    <a href="{{url('/comment/delete/'.$comment->id)}}" class="btn btn-danger">Delete</a>
                                </p>
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

        </div>
    </div>

@endsection
