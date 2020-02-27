@extends('Layout.template')
@section('content')



    <div class="container mb-5">


        <div class="row">
            <div class="card-group d-flex ">
        @foreach ($videos as $video)
                <div class="card col-md-3">
                    <img class="card-img-top" src="{{ route('getThumb', $video->id)  }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $video->title }}</h5>
                        <p class="card-text">{{ $video->description }}</p>
                        <a href="{{url('/video/'.$video->id)}}" class="btn btn-primary">View</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{$video->created_at->diffForHumans()}}</small>
                    </div>
                </div>
        @endforeach
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            {{ $videos->links() }}
        </div>

    </div>



@endsection
